from flask import Flask, request, render_template
import pandas as pd
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
import nltk
from nltk.corpus import stopwords
from nltk.tokenize import word_tokenize

app = Flask(__name__)

# Load your dataset
data = pd.read_csv('legal_dataset.csv')

# Preprocess text data
stop_words = set(stopwords.words('english'))

def preprocess_text(text):
    if isinstance(text, str):  # Check if the input is a string
        tokens = word_tokenize(text.lower())
        tokens = [token for token in tokens if token.isalpha()]
        tokens = [token for token in tokens if token not in stop_words]
        return ' '.join(tokens)
    else:
        return ''  # Return an empty string for non-string inputs

data['preprocessed_text'] = data['Offense'].apply(preprocess_text)

# Vectorize the preprocessed text using TF-IDF
tfidf_vectorizer = TfidfVectorizer()
tfidf_matrix = tfidf_vectorizer.fit_transform(data['preprocessed_text'])

# Compute cosine similarity matrix
cosine_sim = cosine_similarity(tfidf_matrix, tfidf_matrix)

def suggest_ipc_sections(query_text, cosine_sim, data):
    query_vector = tfidf_vectorizer.transform([preprocess_text(query_text)])
    sim_scores = cosine_similarity(query_vector, tfidf_matrix)
    sim_scores = sim_scores.flatten()

    # Sort the documents based on similarity scores
    sorted_indices = sim_scores.argsort()[::-1]

    # Get the top similar documents
    if len(sorted_indices) >= 6:
        top_similar_indices = sorted_indices[:9]  # Return top 6 if available
    else:
        top_similar_indices = sorted_indices[:5]

    # Extract relevant information from the top similar documents
    suggested_sections = data.iloc[top_similar_indices][['Section', 'Offense', 'Punishment']]

    # Concatenate the columns into a new 'Concatenated' column
    suggested_sections['Concatenated'] = suggested_sections.apply(
        lambda row: f"{row['Section']} - {row['Offense']} - {row['Punishment']}", axis=1
    )

    return suggested_sections[['Section', 'Offense', 'Punishment']]

@app.route('/')
def lawstudents():
    return render_template('lawstudents.html')

@app.route('/process', methods=['POST'])
def process():
    problem_text = request.form['problem']
    suggested_sections = suggest_ipc_sections(problem_text, cosine_sim, data)
    return render_template('result.html', sections=suggested_sections.to_dict('records'))

if __name__ == '__main__':
    app.run(debug=True)