Text summarization을 이용한 인공지능 뉴스 헤드라인 제작
============
> NLPG / 문효진, 백지희, 현혜진

# 1. 프로젝트 소개

최근 온라인 기사들의 조회수 경쟁으로 인해 내용과 관련성이 떨어지는 자극적인 제목의 기사들이 늘어나고 있다. 이에 따라 사용자들이 기사를 통해 원하는 정보를 찾는 것에 어려움을 느끼고 있다. 해당 프로젝트에서는 Text summarization을 이용한 인공지능 뉴스 헤드라인 제작 프로젝트를 제안한다. 이 프로젝트는 크게 두 가지로, Extractive Summarization을 하여 기사 전문을 세 줄로 요약하는 것과 Abstractive Summarization을 통해 인공지능이 생성한 뉴스 헤드라인을 제공하는 서비스이다. 기존 기사들에 인공지능 기사 제목을 함께 제공해 사용자들이 합리적이고 효율적으로 원하는 정보를 가진 기사를 찾을 수 있도록 도움을 줄 것이다.

# 2. 구현
현재 구현 페이지 <http://nlpg.pythonanywhere.com>


## 2.1 사용 언어 및 플랫폼

사용 언어: python(+flask), html(+css), sql  
사용 플랫폼: pythonanywhere, mysql

## 2.2 textrank 알고리즘

>text summarization은 extractive summarization과 abstractive summarization으로 나뉘며 textrank 알고리즘은 대표적인 extractive summarization 알고리즘이다.

```python
#textrank 구현 코드 중 일부
class GraphMatrix(object):
    def __init__(self):
        self.tfidf = TfidfVectorizer()
        self.cnt_vec = CountVectorizer()

    def build_mat(self, sentence):
        tfidf_mat = self.tfidf.fit_transform(sentence).toarray()
        return tfidf_mat
```
scikit-learn의 tf-idf vetorizer로 각 문장의 tf-idf matrix를 만든다.

```python
#textrank 구현 코드 중 일부
        def co_sim(n1, n2):
            A = mat[n1]
            B = mat[n2]
            div = norm(A)*norm(B)
            if (div == 0):
                return 0
            return dot(A, B)/div
```
문장 간 가중치로 사용할 cosine similarity 함수이다.

```python
#textrank 구현 코드 중 일부
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
```
NetworkX 라이브러리를 사용해 각 문장들을 edge로, 문장들간의 cosine similarity 값을 weight로 가지는 그래프를 그린다. 그려진 그래프를 기반으로 pagerank 함수를 사용해 랭킹을 매긴다.

# 3. References

textrank 알고리즘  
<https://wikidocs.net/24603>  
<https://github.com/lovit/textrank/>  
<https://github.com/ExcelsiorCJH/Projects/tree/master/Text%20Smmarization>  
<https://github.com/theeluwin/textrankr>  