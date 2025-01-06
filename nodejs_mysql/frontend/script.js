const form = document.getElementById('menuForm');
const nameInput = document.getElementById('name');
const descriptionInput = document.getElementById('description');
const priceInput = document.getElementById('price');
const menuIdInput = document.getElementById('menuId');
const menuList = document.getElementById('menuList');

// Function to fetch and render menu items
async function fetchMenu() {
    const response = await fetch('/menu');
    const menuItems = await response.json();
    menuList.innerHTML = '';
    
    // Loop through menu items and create cards
    menuItems.forEach(item => {
        const col = document.createElement('div');
        col.className = 'col-md-4 mb-4'; // 3 columns layout with margin at bottom

        const card = document.createElement('div');
        card.className = 'card h-100'; // Card class with full height

        const cardBody = document.createElement('div');
        cardBody.className = 'card-body';

        const cardTitle = document.createElement('h5');
        cardTitle.className = 'card-title';
        cardTitle.textContent = item.name;

        const cardDescription = document.createElement('p');
        cardDescription.className = 'card-text';
        cardDescription.textContent = item.description;

        const cardPrice = document.createElement('p');
        cardPrice.className = 'card-text font-weight-bold';
        cardPrice.textContent = `ราคา: ฿${item.price}`;

        const editButton = document.createElement('button');
        editButton.className = 'btn btn-warning btn-sm mx-2';
        editButton.textContent = 'แก้ไข';
        editButton.onclick = () => editMenu(item);
        
        const deleteButton = document.createElement('button');
        deleteButton.className = 'btn btn-danger btn-sm';
        deleteButton.textContent = 'ลบ';
        deleteButton.onclick = () => deleteMenu(item.id);
        
        cardBody.appendChild(cardTitle);
        cardBody.appendChild(cardDescription);
        cardBody.appendChild(cardPrice);
        cardBody.appendChild(editButton);
        cardBody.appendChild(deleteButton);
        card.appendChild(cardBody);
        col.appendChild(card);
        menuList.appendChild(col); // Append column to the menu list
    });
}

// Event to handle form submission
form.addEventListener('submit', async (event) => {
    event.preventDefault();
    const id = menuIdInput.value;
    const name = nameInput.value;
    const description = descriptionInput.value;
    const price = parseFloat(priceInput.value);

    if (id) {
        // Update existing menu item
        const response = await fetch(`/menu/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ name, description, price })
        });

        if (response.ok) {
            menuIdInput.value = ''; // Clear input fields
            nameInput.value = '';
            descriptionInput.value = '';
            priceInput.value = '';
            fetchMenu(); // Refresh menu list
        } else {
            console.error('Error updating menu item');
        }
    } else {
        // Create new menu item
        const response = await fetch('/menu', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ name, description, price })
        });

        if (response.ok) {
            nameInput.value = '';
            descriptionInput.value = '';
            priceInput.value = '';
            fetchMenu(); // Refresh menu list
        } else {
            console.error('Error adding menu item');
        }
    }
});

// Edit Menu Function
function editMenu(item) {
    menuIdInput.value = item.id; // Set hidden field to the item's ID
    nameInput.value = item.name; // Populate the input fields with the item's data
    descriptionInput.value = item.description;
    priceInput.value = item.price;
}

// Delete Menu Function
async function deleteMenu(id) {
    const response = await fetch(`/menu/${id}`, {
        method: 'DELETE'
    });
    if (response.ok) {
        fetchMenu(); // Refresh menu list
    } else {
        console.error('Error deleting menu item');
    }
}

// Fetch menu items when the page loads
window.onload = fetchMenu;