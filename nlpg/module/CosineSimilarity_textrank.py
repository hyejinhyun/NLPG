#!/usr/bin/python
# -*- coding: utf-8 -*-

from urllib.request import urlopen
import urllib.parse
from bs4 import BeautifulSoup

from newspaper import Article
from konlpy.tag import Kkma
from konlpy.tag import Okt
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.feature_extraction.text import CountVectorizer
import networkx as nx
from numpy import dot
from numpy.linalg import norm
import itertools

import pymysql
import threading
from time import sleep

class SentenceTokenizer(object):
    def __init__(self):
        self.kkma = Kkma()
        self.twitter = Okt()

    def text2sentences(self, text):
        sentences = self.kkma.sentences(text)

        return sentences

    def get_nouns(self, sentences):
        nouns = []
        for sentence in sentences:
            if sentence is not '':
                nouns.append(' '.join([noun for noun in self.twitter.nouns(str(sentence))
                                        if len(noun) > 1]))

        return nouns


class GraphMatrix(object):
    def __init__(self):
        self.tfidf = TfidfVectorizer()
        self.cnt_vec = CountVectorizer()

    def build_mat(self, sentence):
        tfidf_mat = self.tfidf.fit_transform(sentence).toarray()
        return tfidf_mat


class TextRank(object):
    def summarize(self, article):
        text = SentenceTokenizer().text2sentences(article)
        n_text = SentenceTokenizer().get_nouns(text)
        mat = GraphMatrix().build_mat(n_text)

        def co_sim(n1, n2):
            A = mat[n1]
            B = mat[n2]
            div = norm(A)*norm(B)
            if (div == 0):
                return 0
            return dot(A, B)/div

        graph = nx.Graph()

        for idx in range(len(n_text)):
            graph.add_node(idx)

        pairs = list(itertools.combinations(range(len(n_text)), 2))

        for n1, n2 in pairs:
            sim = co_sim(n1, n2)
            if sim != 0:
                graph.add_edge(n1, n2, weight=sim)

        pagerank = nx.pagerank(graph, weight='weight')
        reordered = sorted(pagerank, key=pagerank.get, reverse=True)

        sum = []

        for n in reordered[:3]:
            sum.append(text[n])

        graph.clear()

        return sum

def get_art_body(URL):
    a = Article(URL,language='ko')
    a.download()
    a.parse()
    return (a.title,a.text)

def get_sum_list():
    with urllib.request.urlopen("https://www.hankyung.com/society?hkonly=true") as response:
        html = response.read()
        soup = BeautifulSoup(html,'html.parser')
        art_link = soup.select('div.article > span > a')

    articles = []

    for (i,a) in enumerate(art_link):
    #articles[i][0]: 링크, articles[i][1]: 제목, articles[i][2]: 본문
        if i == 5:
            break
        l = a.get('href')
        (t,c) = get_art_body(l)

        r = TextRank().summarize(c)
        r = "-".join(r)
        articles.append([t,r,l])  #[[제목,텍스트랭크,링크],...]]

    return articles

def insert_db():
    conn = pymysql.connect(host='nlpg.mysql.pythonanywhere-services.com', user='nlpg', passwd='ewha1886!', db='nlpg$nlpg', charset='utf8')
    atcList = get_sum_list()
    try:
      for a in atcList:
        with conn.cursor() as cursor:
          sql = 'INSERT INTO news (title,content,url) VALUES (%s, %s, %s)'
          cursor.execute(sql, (a[0],a[1],a[2]))
        conn.commit()
        # print(cursor.lastrowid)

    finally:
        conn.close()
    # print("DB insert 성공")


def myThread(name,nsec):
    insert_db()
    sleep(nsec)

    if __name__ == '__main__':
        t = threading.Thread(target=myThread, args=("Thread-1",300000))
        t.start()
        t.join()

