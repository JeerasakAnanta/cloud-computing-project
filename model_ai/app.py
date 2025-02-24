from flask import Flask, request, jsonify, render_template
from PIL import Image
import io
from ultralytics import YOLO
import os

app = Flask(__name__)

# Load the YOLOv5 model
model = YOLO("model/best.pt")

# Route for the home page (web UI)
@app.route('/')
def home():
    return render_template('index.html')  # Serve the HTML page

# Route for handling image upload and prediction
@app.route('/predict', methods=['POST'])
def predict():
    if request.method == 'POST':
        # Get the image file from the request
        file = request.files['image']
        image_bytes = file.read()
        image = Image.open(io.BytesIO(image_bytes))

        # Perform inference
        results = model(image)

        # Parse the results
        predictions = []
        for result in results:
            for box in result.boxes:
                # Extract bounding box, confidence, and class ID
                x1, y1, x2, y2 = box.xyxy[0].tolist()  # Bounding box coordinates
                confidence = box.conf.item()  # Confidence score
                class_id = int(box.cls.item())  # Class ID
                class_name = model.names[class_id]  # Class name

                # Append the prediction to the list
                predictions.append({
                    "class_id": class_id,
                    "class_name": class_name,
                    "confidence": confidence,
                    "bbox": [x1, y1, x2, y2]  # Bounding box coordinates
                })

        # Return the predictions as JSON
        return jsonify(predictions)

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)