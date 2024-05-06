document.addEventListener("DOMContentLoaded", function () {
  var ikoniceContainers = document.getElementsByClassName("ikonica-container");

  function promeniBoju(klknuto) {
    for (var i = 0; i < ikoniceContainers.length; i++) {
      ikoniceContainers[i].classList.remove("clickedIcon");
      var deca = ikoniceContainers[i].nextElementSibling;
      if (deca && deca.classList.contains("ikonicaHover")) {
        var kocka = deca.querySelector(".kocka");
        var linija = deca.querySelector(".linija");
        if (kocka) {
          kocka.style.backgroundColor = "";
        }
        if (linija) {
          linija.style.backgroundColor = "";
        }
      }
    }
    klknuto.classList.add("clickedIcon");
    var deca = klknuto.nextElementSibling;
    if (deca && deca.classList.contains("ikonicaHover")) {
      var kocka = deca.querySelector(".kocka");
      var linija = deca.querySelector(".linija");
      if (kocka) {
        kocka.style.backgroundColor = "#3678fd";
      }
      if (linija) {
        linija.style.backgroundColor = "#3678fd";
      }
    }
    var sections = document.getElementsByClassName("strana");
    for (var i = 0; i < sections.length; i++) {
      sections[i].classList.remove("active");
    }
    var sectionClass = klknuto.id.replace("btn", ".str");
    var correspondingSection = document.querySelector(sectionClass);
    if (correspondingSection) {
      correspondingSection.classList.add("active");
    }
  }

  for (var i = 0; i < ikoniceContainers.length; i++) {
    ikoniceContainers[i].addEventListener("click", function (event) {
      var klknuto = event.currentTarget;
      promeniBoju(klknuto);
    });
  }

  var defaultSelectedIcon = document.getElementById("btnPocetna");
  promeniBoju(defaultSelectedIcon);

  const endpoint =
    "https://gist.githubusercontent.com/Miserlou/c5cd8364bf9b2420bb29/raw/2bf258763cdddd704f8ffd3ea9a3e81d25e2c6f6/cities.json";

  const cities = [];

  fetch(endpoint)
    .then((raw) => raw.json())
    .then((data) => cities.push(...data));

  function findMatches(wordToMatch, cities) {
    return cities.filter((place) => {
      const regex = new RegExp(wordToMatch, "gi");
      return place.city.match(regex) || place.state.match(regex);
    });
  }

  function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }

  function displayMatches() {
    const matchArray = findMatches(this.value, cities).slice(0, 32);
    const html = matchArray
      .map((place) => {
        const regex = new RegExp(this.value, "gi");
        const cityName = place.city.replace(
          regex,
          `<span class="hl">${this.value}</span>`
        );
        const stateName = place.state.replace(
          regex,
          `<span class="hl">${this.value}</span>`
        );
        return `
                  <li data-city="${place.city}, ${
          place.state
        }" data-population="${place.population}">
                      <span class="name">${cityName}, ${stateName}</span>
                      <span class="population">${numberWithCommas(
                        place.population
                      )}</span>
                  </li>
              `;
      })
      .join("");
    suggestions.innerHTML = html;
  }
  const popupinfoKnjige = document.querySelector(".popupinfoKnjige");

  function closeSuggestions(event) {
    if (!event.target.closest(".suggestions")) {
      suggestions.innerHTML = "";
    }
  }

  function pasteSuggestion(city) {
    searchInput.value = city;
    suggestions.innerHTML = "";
    if (popupinfoKnjige) {
      popupinfoKnjige.classList.add("active");
    }
  }

  const searchInput = document.querySelector(".search");
  const suggestions = document.querySelector(".suggestions");

  searchInput.addEventListener("change", displayMatches);
  searchInput.addEventListener("keyup", displayMatches);
  document.addEventListener("click", closeSuggestions);

  suggestions.addEventListener("click", function (event) {
    if (event.target.tagName === "LI" || event.target.tagName === "SPAN") {
      const city = event.target
        .closest("li")
        .querySelector(".name").textContent;
      pasteSuggestion(city);
    }
  });

  searchInput.addEventListener("focus", function () {
    this.value = "";
  });

  const dugmeOdaberiClanarinu = document.querySelector(".toggle");
  const opcijeClanarine = document.querySelectorAll(".list-item");
  const pozivNaBrojSpan = document.getElementById("pozivNaBroj");

  function generateRandomNumber() {
    let randomNumber = "";
    for (let i = 0; i < 5; i++) {
      const randomArray = new Uint32Array(1);
      crypto.getRandomValues(randomArray);
      randomNumber += String(randomArray[0] % 10000).padStart(4, "0");
    }
    return randomNumber;
  }

  const usedNumbers = new Set();

  opcijeClanarine.forEach((item) => {
    item.addEventListener("click", () => {
      console.log("Clicked item:", item.textContent);
      dugmeOdaberiClanarinu.textContent = item.textContent.trim();
      console.log(
        "dugmeOdaberiClanarinu text:",
        dugmeOdaberiClanarinu.textContent
      );
      console.log("Odabrano:", dugmeOdaberiClanarinu.textContent);

      if (
        dugmeOdaberiClanarinu.textContent === "MESECNO ELEKTRONSKI" ||
        dugmeOdaberiClanarinu.textContent === "GODISNJE ELEKTRONSKI"
      ) {
        let randomNumber;
        do {
          randomNumber = generateRandomNumber();
          console.log("Generisan poziv na broj:", randomNumber);
        } while (usedNumbers.has(randomNumber));
        usedNumbers.add(randomNumber);
      }
    });
  });

  const btn_odustaniDodajclana = document.getElementById("odustanidodajClana");
  const btn_odustanipopDodajclana = document.getElementById(
    "odustani_dodajClana"
  );
  const btn_potvrdiDodajclana = document.getElementById("potvrdidodajClana");
  const btn_potvrdipopDodajclana =
    document.getElementById("potvrdi_dodajClana");
  const btn_dodajClana = document.querySelector(".dodajclanaBG");
  const dodajClanaPopUp = document.querySelector(".dodavanjeClanaPopUp");
  const popuppotvrdaPotvrde = document.querySelector(
    ".potvrdazadodavanjeclana"
  );

  btn_dodajClana.addEventListener("click", () => {
    dodajClanaPopUp.classList.add("active");
    dodajClanaPopUp.style.display = "flex";
    console.log("Klinuto dugme za otvaranje pop up za dodavanje clana");
  });

  btn_odustaniDodajclana.addEventListener("click", () => {
    dodajClanaPopUp.classList.remove("active");
    console.log("Klinuto dugme za odustajanje od kreiranja novog clana");
  });

  btn_potvrdiDodajclana.addEventListener("click", () => {
    popuppotvrdaPotvrde.classList.add("active");
    console.log("Klinuto dugme za potvrdjivanje od kreiranja novog clana");
  });

  btn_odustanipopDodajclana.addEventListener("click", () => {
    dodajClanaPopUp.classList.remove("active");
    popuppotvrdaPotvrde.classList.remove("active");
    console.log(
      "Klinuto dugme za odustajanje od kreiranja novog clana u pop up"
    );
  });

  btn_potvrdipopDodajclana.addEventListener("click", () => {
    dodajClanaPopUp.classList.remove("active");
    popuppotvrdaPotvrde.classList.remove("active");
    console.log(
      "Klinuto dugme za potvrdjivanje od kreiranja novog clana u pop up"
    );
  });

  $(".tab-link").click(function () {
    var tabID = $(this).attr("data-tab");

    $(this).addClass("active").siblings().removeClass("active");

    $("#tab-" + tabID)
      .addClass("active")
      .siblings()
      .removeClass("active");
  });
  var dateInput = document.getElementById("datumDodajClana");

  if (dateInput) {
    dateInput.addEventListener("change", function () {
      var selectedDate = dateInput.value;
      console.log("Selected date:", selectedDate);
    });
  }

  const zatvoriIOKBtn = document.getElementById("zatvoriInfoKnjige");

  zatvoriIOKBtn.addEventListener("click", () => {
    popupinfoKnjige.classList.remove("active");
  });

  btn_potvrdipopDodajclana.addEventListener("click", function () {
    const ime = document.getElementById("imeDodajClana").value;
    const prezime = document.getElementById("prezimeDodajClana").value;
    const brojTelefona = document.getElementById("telefonDodajClana").value;
    const email = document.getElementById("emailDodajClana").value;
    const datumRodjenja = document.getElementById("datumDodajClana").value;
    const adresaStanovanja = document.getElementById("adresaDodajClana").value;
    const clanarina = document.querySelector(".toggle").textContent;
    console.log("Klknuto dugme za potvrdu");

    // Generate random number
    const randomNumber = generateRandomNumber();
    var xhr = new XMLHttpRequest();
    console.log(xhr.status)
    $.ajax({
        type: "POST",
        url: "../dodajClana.php",
        data: {
            ime: ime,
            prezime: prezime,
            brojTelefona: brojTelefona,
            email: email,
            datumRodjenja: datumRodjenja,
            adresaStanovanja: adresaStanovanja,
            clanarina: clanarina,
            pozivnabroj: randomNumber,
        },
        success: function (response) {
            console.log("------------------------------SLANJE EMAILA-----------------------------------------");
            console.log("Ime: " + ime);
            console.log("Prezime" + prezime);
            console.log("Broj telefona" + brojTelefona);
            console.log("Email" + email);
            console.log("Datum rodjenja" + datumRodjenja);
            console.log("Adresa stanovanja" + adresaStanovanja);
            console.log("Clanarina" + clanarina);
            console.log("Poziv na broj" + randomNumber);
            console.log("Email sent successfully!");
            console.log("AJAX request successful");
            console.log(response); // Log the response from the server
            console.log("-----------------------------------------------------------------------");

        },
        error: function (xhr, status, error) {
            // Handle error response
            console.error("Email sending failed.");
            console.error("AJAX request failed");
            console.error(error); // Log the error message
        },
    });

    console.log("Klinuto dugme za potvrdjivanje od kreiranja novog clana");
});

      
$(function(){
      $('table').tablesorter(); 
    });
});
