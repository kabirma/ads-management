
// control the change period input


  document.getElementById('changePeriodBtn').addEventListener('click', function () {
    const input = document.createElement('input');
    input.type = 'date';
    input.className = 'form-control chnage-periodbtn';
    input.style.width = '100%';

    const container = document.getElementById('period-control');
    container.innerHTML = '';
    container.appendChild(input);

    // Give the DOM a moment to render the input before triggering the calendar
    setTimeout(() => {
      input.focus();
      input.click(); // Triggers the calendar dropdown in most modern browsers
    }, 50);
  });


// here control the card and table functionality
const showTableBtn = document.getElementById("show-table");
const showCardBtn = document.getElementById("show-card");
const table = document.getElementById("campaignTable");
const cards = document.querySelector(".card-container");

showTableBtn.addEventListener("click", function () {
  table.classList.remove("d-none");
  cards.classList.add("d-none");

  showTableBtn.classList.add("active");
  showCardBtn.classList.remove("active");

  // Smooth scroll to table
  table.scrollIntoView({ behavior: "smooth" });
});

showCardBtn.addEventListener("click", function () {
  table.classList.add("d-none");
  cards.classList.remove("d-none");

  showCardBtn.classList.add("active");
  showTableBtn.classList.remove("active");

  // Smooth scroll to cards
  cards.scrollIntoView({ behavior: "smooth" });
});





