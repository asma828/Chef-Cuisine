// burger menu
document.getElementById('menu-button').addEventListener('click', function() {
    const menu = document.getElementById('menu');
    menu.classList.toggle('-translate-x-full');
});

//add menu for the chef
document.getElementById('open-menu-form').addEventListener('click', function() {
    const formContainer = document.getElementById('menu-form-container');
    formContainer.classList.toggle('hidden');
});

let dishCount = 1;

document.getElementById('add-dish').addEventListener('click', function() {
    dishCount++;
    const newDish = document.createElement('div');
    newDish.classList.add('dish-field', 'mb-4');
    newDish.innerHTML = `
        <label for="dish-name-${dishCount}" class="block text-sm font-bold mb-2">Dish Name</label>
        <input type="text" id="dish-name-${dishCount}" name="dish-name[]" class="w-full px-3 py-2 border rounded-md mb-2" required>
        <label for="dish-image-${dishCount}" class="block text-sm font-bold mb-2">Dish Image URL</label>
        <input type="text" id="dish-image-${dishCount}" name="dish-image[]" class="w-full px-3 py-2 border rounded-md mb-2" required>
        <button type="button" class="remove-dish bg-red-500 text-white px-2 py-1 rounded-md">Remove</button>
    `;
    document.getElementById('dishes-section').appendChild(newDish);
});

document.getElementById('dishes-section').addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('remove-dish')) {
        e.target.parentNode.remove();
    }
});



document.getElementById('menu-button').addEventListener('click', function() { 
    const menu = document.getElementById('menu'); 
    menu.classList.toggle('-translate-x-full'); 
}); 
function openReservationForm(menuName, menuPrice) { 
    document.getElementById('menu-name').value = menuName; 
    document.getElementById('menu-price').value = menuPrice; 
    document.getElementById('reservation-modal').classList.remove('hidden'); 
} 
function closeReservationForm() { 
    document.getElementById('reservation-modal').classList.add('hidden');
 }