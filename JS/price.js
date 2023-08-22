const plus = document.getElementById("plus");
const minus = document.getElementById("minus");
let quantity = document.getElementsByName("quantity")[0];
let currentValue = parseInt(quantity.value);;
let totalActualPrice=0;
let totalPrice = 0;
plus.addEventListener("click", () => {
    currentValue++;
    quantity.value = currentValue;
    updatePrice();
});

minus.addEventListener("click", () => {
    if (currentValue > 1) {
        currentValue--;
        quantity.value = currentValue;
        updatePrice();
    }
});

let price = document.querySelector('.single_price');
let actual_price = document.querySelector('.actual_price');
let pricePerunit = parseFloat(price.textContent);
let actual_perUnit = parseFloat(actual_price.textContent);
let food_price = document.getElementsByName('food_price')[0];
let food_quan = document.getElementsByName('food_quan')[0];
function updatePrice() {
    totalPrice = currentValue * pricePerunit;
    price.textContent = totalPrice;
    food_quan.value=currentValue;
    food_price.value=totalPrice;
    totalActualPrice = currentValue * actual_perUnit;
    actual_price.textContent = totalActualPrice;
};

