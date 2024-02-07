const filterGender = document.querySelector("#gender");
const filterCategory = document.querySelector("#category");
const filterPrice = document.querySelector("#price");
const products = document.querySelectorAll(".product");
filterGender.onchange = () => {
  filterProducts(filterGender.value, filterCategory.value, filterPrice.value);
};
filterCategory.onchange = () => {
  filterProducts(filterGender.value, filterCategory.value, filterPrice.value);
};
filterPrice.onchange = () => {
  filterProducts(filterGender.value, filterCategory.value, filterPrice.value);
};
function filterProducts(gender, category, price) {
  products.forEach((product) => {
    const productGender = product.querySelector(".product-gender").innerText;
    const productCategory =
      product.querySelector(".product-category").innerText;
    const productPrice = product.querySelector(".product-price").innerText;
    if (
      productGender.indexOf(gender) > -1 &&
      productCategory.indexOf(category) > -1 &&
      productPrice.indexOf(price) > -1
    ) {
      product.style.display = "";
    } else {
      product.style.display = "None";
    }
    document
      .querySelector(".products-list")
      .scrollIntoView({ behavior: "smooth", block: "center" });
  });
}
const categoriesArr = [];
const pricesArr = [];
products.forEach((product) => {
  const category = product.querySelector(".product-category").innerText;
  const price = product.querySelector(".product-price").innerText;
  if (!categoriesArr.includes(category)) {
    categoriesArr.push(category);
    filterCategory.innerHTML += `<option value='${category}'>${category}</option>`;
  }
  if (!pricesArr.includes(price)) {
    pricesArr.push(price);
    filterPrice.innerHTML += `<option value='${price}'>${price}</option>`;
  }
});
