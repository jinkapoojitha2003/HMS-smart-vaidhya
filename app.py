from flask import Flask, render_template, request
import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestClassifier
from sklearn.preprocessing import LabelEncoder

app = Flask(__name__)

# Load the dataset (CSV file)
dataset = pd.read_csv('symptom_disease.csv')

# Preprocessing the dataset
def preprocess_data(dataset):
    # Ensure 'diseases' is the first column
    if dataset.columns[0].lower() != 'diseases':
        raise ValueError("First column must be 'diseases'")

    # Label encoding the 'diseases' column (target variable)
    label_encoder = LabelEncoder()
    dataset['diseases'] = label_encoder.fit_transform(dataset['diseases'])

    # Features are all columns except the first one ('diseases')
    X = dataset.drop('diseases', axis=1)
    y = dataset['diseases']
    
    return X, y, label_encoder

# Reduce the dataset size to avoid memory issues
dataset = dataset.sample(n=10000, random_state=42)  # Use only the first 10,000 rows

# Train the model
X, y, label_encoder = preprocess_data(dataset)
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Use fewer trees, reduce depth, and limit parallel processing
model = RandomForestClassifier(n_estimators=50, max_depth=10, n_jobs=2, random_state=42)

# Fit the model
model.fit(X_train, y_train)

# Route to show the symptom checker page
@app.route('/symptoms-checker')
def symptoms_checker():
    return render_template('index.html', disease=None, symptoms=X.columns)

# Main route for prediction (handles both GET and POST)
@app.route('/', methods=['GET', 'POST'])
def index():
    if request.method == 'POST':
        # Get the symptoms selected by the user from the form
        symptoms = [int(request.form.get(symptom, 0)) for symptom in X.columns]  # Convert form inputs to integers
        
        # Predict the disease using the trained model
        predicted_disease = model.predict([symptoms])[0]
        
        # Decode the predicted disease
        disease_name = label_encoder.inverse_transform([predicted_disease])[0]
        
        return render_template('index.html', disease=disease_name, symptoms=X.columns)
    
    return render_template('index.html', disease=None, symptoms=X.columns)

if __name__ == '__main__':
    app.run(debug=True)
