import os  
from flask import Flask, render_template, request, redirect, url_for, flash
import mysql.connector
from mysql.connector import Error
from dotenv import load_dotenv
import logging

load_dotenv('.env')

# Logging configuration
logging.basicConfig(level=logging.INFO)

app = Flask(__name__)
app.secret_key = 'your_secret_key'  # Required for using flash messages

def create_connection():
    connection = None
    try:
        connection = mysql.connector.connect(
            host=os.getenv("DB_HOST"),
            user=os.getenv("DB_USER"),        
            password=os.getenv("DB_PASSWORD"), 
            database=os.getenv("DB_NAME")
        )
        logging.info("Connected to the database successfully")
    except Error as e:
        logging.error(f"Error connecting to MySQL: {e}")
    
    return connection

@app.route('/')
def index():
    connection = create_connection()
    menu_items = []
    if connection:
        try:
            cursor = connection.cursor(dictionary=True)
            cursor.execute("SELECT * FROM menu")
            menu_items = cursor.fetchall()
            cursor.close()
        except Error as e:
            logging.error(f"Error executing query: {e}")
        finally:
            connection.close()

    return render_template('index.html', menu_items=menu_items)

@app.route('/add_menu_item', methods=['POST'])
def add_menu_item():
    name = request.form.get('name')
    description = request.form.get('description')
    price = request.form.get('price')

    connection = create_connection()
    
    if connection:
        try:
            cursor = connection.cursor()
            cursor.execute("INSERT INTO menu (name, description, price) VALUES (%s, %s, %s)", 
                           (name, description, price))
            connection.commit()
            cursor.close()
            flash('Menu item added successfully!', 'success')
        except Error as e:
            logging.error(f"Error inserting into table: {e}")
            flash('Error adding menu item', 'danger')
        finally:
            connection.close()
    
    return redirect(url_for('index'))

@app.route('/edit_menu_item/<int:id>')
def edit_menu_item(id):
    connection = create_connection()
    menu_item = {}
    
    if connection:
        try:
            cursor = connection.cursor(dictionary=True)
            cursor.execute("SELECT * FROM menu WHERE id = %s", (id,))
            menu_item = cursor.fetchone()
            cursor.close()
        except Error as e:
            logging.error(f"Error retrieving menu item: {e}")
        finally:
            connection.close()
    
    return render_template('edit_menu_item.html', menu_item=menu_item)

@app.route('/update_menu_item/<int:id>', methods=['POST'])
def update_menu_item(id):
    name = request.form.get('name')
    description = request.form.get('description')
    price = request.form.get('price')

    connection = create_connection()
    
    if connection:
        try:
            cursor = connection.cursor()
            cursor.execute("UPDATE menu SET name = %s, description = %s, price = %s WHERE id = %s", 
                           (name, description, price, id))
            connection.commit()
            cursor.close()
            flash('Menu item updated successfully!', 'success')
        except Error as e:
            logging.error(f"Error updating menu item: {e}")
            flash('Error updating menu item', 'danger')
        finally:
            connection.close()
    
    return redirect(url_for('index'))

@app.route('/delete_menu_item/<int:id>', methods=['POST'])
def delete_menu_item(id):
    connection = create_connection()
    
    if connection:
        try:
            cursor = connection.cursor()
            cursor.execute("DELETE FROM menu WHERE id = %s", (id,))
            connection.commit()
            cursor.close()
            flash('Menu item deleted successfully!', 'success')
        except Error as e:
            logging.error(f"Error deleting menu item: {e}")
            flash('Error deleting menu item', 'danger')
        finally:
            connection.close()
    
    return redirect(url_for('index'))

if __name__ == '__main__':
    app.run(debug=True)
