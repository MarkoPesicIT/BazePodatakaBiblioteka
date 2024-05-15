// Function to reserve a car
function reserveCar(carId, carPrice) {
      var userName = prompt("Unesite ime i prezime korisnika:");
      var startDate = prompt("Unesite datum početka iznajmljivanja (YYYY-MM-DD):");
      var endDate = prompt("Unesite datum završetka iznajmljivanja (YYYY-MM-DD):");
  
      // Provera da li su sva polja popunjena
      if (userName && startDate && endDate) {
          // Provera da li su uneti datumi ispravni
          if (isValidDate(startDate) && isValidDate(endDate)) {
              // Provera da li je krajnji datum nakon početnog datuma
              if (new Date(endDate) > new Date(startDate)) {
                  // Rezervacija se izvršava ako su svi uslovi ispunjeni
                  // Dummy data for demonstration, you should replace this with actual functionality
                  var userId = 1; // Assuming user ID is 1 for demonstration purposes
  
                  // Calculate total price based on rental period
                  var rentalDays = Math.ceil((new Date(endDate) - new Date(startDate)) / (1000 * 60 * 60 * 24));
                  var totalPrice = rentalDays * carPrice;
  
                  // Object with data to be sent to the server
                  var data = {
                      carId: carId,
                      userId: userId,
                      userName: userName,
                      startDate: startDate,
                      endDate: endDate
                  };
  
                  // Options for Fetch API
                  var options = {
                      method: 'POST',
                      headers: {
                          'Content-Type': 'application/json'
                      },
                      body: JSON.stringify(data)
                  };
  
                  // Sending request to the server
                  fetch('rezervisiAuto.php', options)
                      .then(response => {
                          if (!response.ok) {
                              throw new Error('Network response was not ok');
                          }
                          return response.text();
                      })
                      .then(data => {
                          // Showing reservation information and price
                          var message = "Automobil je uspešno rezervisan za " + rentalDays + " dana. Cena iznosi " + totalPrice.toFixed(2) + " EUR.";
                          alert(message);
                          // Optionally, you can update the UI after successful reservation
                          location.reload(); // Optional page refresh after reservation
                      })
                      .catch(error => {
                          console.error('There has been a problem with your fetch operation:', error);
                          alert('Greška prilikom rezervacije automobila.');
                      });
              } else {
                  alert("Krajnji datum mora biti nakon početnog datuma.");
              }
          } else {
              alert("Molimo unesite ispravan format datuma (YYYY-MM-DD).");
          }
      } else {
          alert("Molimo unesite sve potrebne informacije.");
      }
  }
  // Function to check if a given string is a valid date in YYYY-MM-DD format
function isValidDate(dateString) {
      var regex = /^\d{4}-\d{2}-\d{2}$/;
      return regex.test(dateString);
  }
  // Funkcija za otkazivanje rezervacije
function cancelBooking(bookingId) {
      if (confirm("Da li ste sigurni da želite da otkažete rezervaciju?")) {
          // Objekat sa podacima koji će biti poslati serveru
          var data = {
              bookingId: bookingId
          };
  
          // Opcije za Fetch API
          var options = {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json'
              },
              body: JSON.stringify(data)
          };
  
          // Slanje zahteva serveru za otkazivanje rezervacije
          fetch('otkaziRezervaciju.php', options)
              .then(response => {
                  if (!response.ok) {
                      throw new Error('Network response was not ok');
                  }
                  return response.text();
              })
              .then(data => {
                  // Prikazivanje poruke o uspešnom otkazivanju
                  alert(data);
                  // Opciono, ažuriranje UI nakon uspešnog otkazivanja
                  location.reload(); // Opcionalno osvežavanje stranice nakon otkazivanja
              })
              .catch(error => {
                  console.error('There has been a problem with your fetch operation:', error);
                  alert('Greška prilikom otkazivanja rezervacije.');
              });
      }
  }

 // Funkcija za slanje podataka forme
 function addUser() {
      var username = prompt("Unesite korisničko ime:");
      var email = prompt("Unesite email adresu:");
      var imePrezime = prompt("Unesite ime i prezime:");
  
      if (username && email && imePrezime) {
          var data = {
              username: username,
              email: email,
              imePrezime: imePrezime
          };
  
          fetch('dodaj_korisnika.php', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json'
              },
              body: JSON.stringify(data)
          })
          .then(response => {
              if (!response.ok) {
                  throw new Error('Network response was not ok');
              }
              return response.text();
          })
          .then(data => {
              alert('Korisnik je uspešno dodat.');
              location.reload(); // Opcionalno osvežavanje stranice nakon dodavanja
          })
          .catch(error => {
              console.error('There has been a problem with your fetch operation:', error);
              alert('Greška prilikom dodavanja korisnika.');
          });
      } else {
          alert("Molimo unesite sve podatke.");
      }
  }
  
  