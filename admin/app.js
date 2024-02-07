const previewImage = (imageInput, imagePreview) => {
  const input = document.querySelector(imageInput);
  const preview = document.querySelector(imagePreview);

  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = (e) => {
      preview.src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
  }
};

const rows = document.querySelectorAll(".data-row");
const searchBar = document.querySelector("#data-search");

if (searchBar) {
  searchBar.addEventListener("keyup", () => {
    const search = searchBar.value;
    rows.forEach((row) => {
      cols = row.querySelectorAll("td");
      for (let i = 0; i < cols.length; i++) {
        if (cols[i].outerText.indexOf(search) > -1) {
          row.style.display = "";
          break;
        } else {
          row.style.display = "none";
        }
      }
    });
  });
}
const openModal = () => {
  const modal = document.querySelector("#modal");
  modal.classList.toggle("hidden");
  document.querySelector("#modal-overlay").addEventListener("click", openModal);
};
