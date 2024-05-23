let cart = [];

function addToCart(productName, price, imageUrl) {
    const product = { name: productName, price: price, image: imageUrl };
    cart.push(product);
    updateCartUI();
}

function removeFromCart(productName) {
    cart = cart.filter(product => product.name !== productName);
    updateCartUI();
}

function updateCartUI() {
    const cartList = document.getElementById('cart-list');
    cartList.innerHTML = '';
    let total = 0;

    cart.forEach(product => {
        const item = document.createElement('div');
        item.classList.add('cart-item');
        item.innerHTML = `
            <div class="cart-item-info">
                <img src="${product.image}" alt="${product.name}" class="cart-item-image">
                <p class="cart-item-title">${product.name}</p>
                <p class="cart-item-price">$${product.price}</p>
            </div>
            <div class="cart-item-actions">
                <button class="boton-eliminar" onclick="removeFromCart('${product.name}')">Eliminar</button>
            </div>
        `;
        cartList.appendChild(item);
        total += product.price;
    });

    document.getElementById('cart-count').textContent = cart.length;
    document.getElementById('cart-total-price').textContent = `$${total.toFixed(2)}`;
}

function showCart() {
    document.getElementById('cart-modal').style.display = 'block';
}

function closeCart() {
    document.getElementById('cart-modal').style.display = 'none';
}

document.querySelector('.cart-icon a').addEventListener('click', showCart);
document.querySelector('.close').addEventListener('click', closeCart);

updateCartUI();
