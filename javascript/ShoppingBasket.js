/**
 * @typedef {Object} Basket
 * @property {Object.<number, BasketItem>} items - List of item IDs in the basket
 */
/**
 * @typedef {Object} BasketItem
 * @property {string} title
 * @property {number} count
 */

const basket = getBasket();
const basketCounter = document.getElementById("basketCounter");
const basketNormalDisplay = basketCounter.style.display;

updateBasketUi();

function addToBasket(id) {
    if (!basket.items[id]) {
        basket.items[id] = {};
    }
    basket.items[id].count = (basket.items[id].count ?? 0) + 1;
    saveBasket();
    updateBasketUi();
}

function removeItem(id) {
    if (!basket.items[id]) {
        return;
    }

    if (basket.items[id].count > 1) {
        basket.items[id].count--;
    } else {
        delete basket.items[id];
    }
    saveBasket();
    updateBasketUi();
}

function removeItemAll(id) {
    if (!basket.items[id]) {
        return;
    }

    delete basket.items[id];
    saveBasket();
    updateBasketUi();
}

/**
 * @returns {Basket}
 */
function getBasket() {
    let basket = localStorage.getItem("sb-basket");
    if (basket == null) {
        /** @type {Basket} */
        const newBasket = { items: {} };
        localStorage.setItem("sb-basket", JSON.stringify(newBasket));
        return newBasket;
    } else {
        return JSON.parse(basket);
    }
}

function saveBasket() {
    localStorage.setItem("sb-basket", JSON.stringify(basket));
}

async function updateBasketUi() {
    const basketItemTemplate = document.getElementById("basketItem");
    const basketItemsPlaceholder = document.getElementById("basketItemsPlaceholder");

    basketItemsPlaceholder.innerHTML = "";

    for (const [key, value] of Object.entries(basket.items)) {
        let itemInfo;
        if (value.name == null) {
            await fetch(`controller/?action=getProductInfo&id=${key}`)
                .then(async value1 => {
                    if (value1.ok) {
                        return await value1.json();
                    } else {
                        return null;
                    }
                })
                .then(value1 => {
                    itemInfo = value1;
                });
        } else {
            itemInfo = value;
        }
        const clone = basketItemTemplate.content.cloneNode(true);

        if (itemInfo == null) {
            removeItemAll(key);
            continue;
        }

        console.log(itemInfo);

        const itemLiTag = clone.querySelector("li.list-group-item");
        itemLiTag.id = `item-${itemInfo.product_id}`;

        const itemTitle = clone.getElementById("itemTitle");
        itemTitle.innerText = itemInfo.title;

        const itemCount = clone.getElementById("count");
        itemCount.value = value.count;

        const itemCountDecrease = clone.getElementById("itemCountDecrease");
        itemCountDecrease.addEventListener("click", () => {
            removeItem(key);
        });

        const itemCountIncrease = clone.getElementById("itemCountIncrease");
        itemCountIncrease.addEventListener("click", () => {
            addToBasket(key);
        });

        basketItemsPlaceholder.appendChild(clone);
    }

    updateBasketCounter();
}

function updateBasketCounter() {
    let numberOfItems = 0;
    Object.keys(basket.items).forEach(value => {
        numberOfItems += basket.items[value].count;
    });

    if (numberOfItems === 0) {
        basketCounter.style.display = "none";
    } else {
        basketCounter.innerText = numberOfItems.toString();
        basketCounter.style.display = basketNormalDisplay;
    }
}

// fetch("controller/?action=getProductInfo&id=100000")
//     .then(value => value.json())
//     .then(value => console.log(value));
