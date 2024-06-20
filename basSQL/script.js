// bouton pour revenir en haut de la base page ------------------------------>

window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("btnScrollToTop").style.display = "block";
  } else {
    document.getElementById("btnScrollToTop").style.display = "none";
  }
}

function scrollToTop() {
  document.body.scrollTop = 0; // Pour les anciens navigateurs
  document.documentElement.scrollTop = 0; // Pour les nouveaux navigateurs
}
/*----------------- GESTION DU CLICK SOURIS -----------------------------------------------*/

document.addEventListener("DOMContentLoaded", () => {
  const cardContainers = document.querySelectorAll(".card-container");

  cardContainers.forEach((container) => {
    let isDown = false;
    let startX;
    let scrollLeft;

    container.addEventListener("mousedown", (e) => {
      isDown = true;
      container.classList.add("active");
      startX = e.pageX - container.offsetLeft;
      scrollLeft = container.scrollLeft;
    });

    container.addEventListener("mouseleave", () => {
      isDown = false;
      container.classList.remove("active");
    });

    container.addEventListener("mouseup", () => {
      isDown = false;
      container.classList.remove("active");
    });

    container.addEventListener("mousemove", (e) => {
      if (!isDown) return;
      e.preventDefault();
      const x = e.pageX - container.offsetLeft;
      const walk = (x - startX) * 3; // Scroll-fast
      container.scrollLeft = scrollLeft - walk;
    });
  });
});

/*----------------- GESTION DU CLICK SOURIS -----------------------------------------------*/

function clipSelected(content) {
  let url =
    "../infos_clips.json" +
    content;
  fetch(url).then((infos_clips) =>
    infos_clips.json().then((data) => {
      console.log(data);
      document.querySelector("#home").innerHTML = data.main;
      document.querySelector("#clips").innerHTML = data.main;
      document.querySelector("#originals").innerHTML = data.main;
      document.querySelector("#search").innerHTML = data.main;
      document.getElementById("card-container").style.display = "card";
    })
  );
}

function mouseOverClips() {
  for (let i = 0; i < clips.length; i++) {
    document.getElementById(content[i]).addEventListener("mouseenter", () => {
      //clipSelected(infos_clips[i]);
      document.getElementById("name").hidden = true;
    });
  }
}

function mouseOutClips() {
  for (let i = 0; i < clips.length; i++) {
    document.getElementById(content[i]).addEventListener("mouseleave", () => {
      //handleMouseOutClips();
      document.getElementById("card").hidden = false;
    });
  }
}

function handleMouseOutClips() {
  document.getElementById("card-container").style.display = "none";
}

function mouseOutInfos() {
  for (let i = 0; i < infos_clips.length; i++) {
    document
      .getElementById(content[i])
      .addEventListener("mouseleave", handleMouseOutInfos);
  }
}

function handleMouseOutInfos() {
  document.getElementById("content-section").style.display = "shows";
}

document.addEventListener(
  "info_clips.json",
  function () {
    const content = document.getElementById("filters");
  },
  false
);

// ----------------------- GESTION DU FICHIER JSON ---------------------------------------------->
/*
document.addEventListener("DOMContentLoaded", () => {
  const cardContainer = document.getElementById("card-container", "card-container_2");
  const filtersNav = document.getElementById("filters-nav");

  async function fetchData(filter = "all") {
    try {
      const infos_clips = await fetch("../infos_clips.json");
      const data = await infos_clips.json();
      // debugger;
      if (data.Clips === localStorage.getItem("filter")) {
        return data.Clips.id[0];
      } else {
        localStorage.setItem("filter", filter);
      }
      displayCards(data, filter);
      generateFilters(data);
    } catch (error) {
      console.error("Erreur lors de la récupération des données:", error);
    }
  }

  function displayCards(data, filter) {
    cardContainer.innerHTML = "";
    const filteredData =
      filter === "all" ? data : data.filter((item) => item.category === filter);

    filteredData.forEach((item) => {
      const card = document.createElement("div");
      card.classList.add("card");
      card.innerHTML = `
                <img src="${item.image}" alt="${item.alt}">
                <h3>${item.nom}</h3>
            `;
      cardContainer.appendChild(card);
    });
  }

  function generateFilters(data) {
    const categories = ["all", ...new Set(data.map((item) => item.category))];
    filtersNav.innerHTML = categories
      .map(
        (category) =>
          `<li><button data-filter="${category}">${category}</button></li>`
      )
      .join("");

    // Gestion des événements sur les filtres
    filtersNav.querySelectorAll("button").forEach((button) => {
      button.addEventListener("click", (e) => {
        const filter = e.target.getAttribute("data-filter");
        fetchData(filter);
      });
    });
  }

  fetchData();
});

document.addEventListener('DOMContentLoaded', () => {
  const cardContainer = document.getElementById('card-container');
  const filtersNav = document.getElementById('filters-nav');

  async function fetchData(filter = "all") {
      try {
          const response = await fetch("../infos_clips.json"); // Mon URL d'API
          const data = await response.json();
          displayCards(data, filter);
          generateFilters(data);
      } catch (error) {
          console.error("Erreur lors de la récupération des données:", error);
      }
  }
 
  function displayCards(data, filter) {
      cardContainer.innerHTML = "card";
      const filteredData = filter === "all" ? data : data.filter(item => item.category === filter);
      
      filteredData.forEach(item => {
          const card = document.createElement("div");
          card.classList.add("card");
          card.innerHTML = `
              <img src="${item.image}" alt="${item.alt}">
              <h3>${item.nom}</h3>
          `;
          cardContainer.appendChild(card);
      });
  }

  function generateFilters(data) {
      const categories = ["all", ...new Set(data.map(item => item.category))];
      filtersNav.innerHTML = categories.map(category => 
          `<li><button data-filter="${category}">${category}</button></li>`
      ).join('');

      // Ajout des écouteurs d'événements pour les boutons de filtre
      filtersNav.querySelectorAll("button").forEach(button => {
          button.addEventListener("click", (e) => {
              const filters = e.target.getAttribute("data-filter");
              fetchData(filters);
          });
      });
  }

  fetchData();
});
*/
// --- > -----------------------LOGIN AREA----------------------------------------->

  // Gestion de la connexion ----------------------------------------->
  const loginForm = document.getElementById("login.php");
  if (loginForm) {
      loginForm.addEventListener("submit", (e) => {
          e.preventDefault();
          const username = e.target.username.value;
          const password = e.target.password.value;
          //  vérification réelle
          if (username === "user" && password === "password") {
              alert("Connexion réussie !");
              window.location.href = "AtoProd.html"; // Retour vers la page principale après connexion
          } else {
              alert("Nom d\'utilisateur ou mot de passe incorrect.");
          }
      });
    // Fonctions pour ouvrir et fermer la navigation latérale ----------------------------------------->
    document.querySelector('.openbtn').addEventListener('click', openNav);
    document.querySelector('.closebtn').addEventListener('click', closeNav);
}

openNav();
closeNav();

function openNav() {
    document.getElementById('side-nav').style.width = '250px';
}

function closeNav() {
    document.getElementById('side-nav').style.width = '0';
}


// Fonctions pour la gestions des likes et des pas likes ----------------------------------------->
function likeComment(commentId) {
  fetch("like_dislike.php", {
      method: "POST",
      headers: {
          "Content-Type": "php://input"
      },
      body: JSON.stringify({ comment_id: commentId })
  })
  .then(response => response.json())
  .then(data => {
      if (data.success) {
          location.reload();
      } else {
          alert("Erreur lors de l'ajout du like.");
      }
  });
}

function dislikeComment(commentId) {
  fetch("dislike_comment.php", {
      method: "POST",
      headers: {
          "Content-Type": "php://input"
      },
      body: JSON.stringify({ comment_id: commentId })
  })
  .then(response => response.json())
  .then(data => {
      if (data.success) {
          location.reload();
      } else {
          alert("Erreur lors de l'ajout du dislike.");
      }
  });
}