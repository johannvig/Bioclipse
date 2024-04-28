window.addEventListener("DOMContentLoaded", (event) => {
  const producer = document.getElementsByName("is_producer")[0];
  const producerInputs = document.getElementsByClassName("producer_input");
  producer.checked = false;
  for (let i = 0; i < producerInputs.length; i++) {
    producerInputs[i].disabled = !producerInputs[i].disabled;
  }

  producer.addEventListener("change", (event) => {
    for (let i = 0; i < producerInputs.length; i++) {
      producerInputs[i].disabled = !producerInputs[i].disabled;
    }
  });

  const btnNext = document.querySelector("form .btn .next");
  const btnPrev = document.querySelector("form .btn .prev");
  const indicator = document.querySelector(".indicator .line span");
  const indicatorItems = document.querySelectorAll(".indicator p");
  const form = document.querySelector("form");
  const allTab = document.querySelectorAll("form .tab");
  let currentTab = 0;

  allTab[currentTab].classList.add("show");
  indicator.style.width = currentTab;
  indicatorItems[currentTab].classList.add("active");

  if (currentTab == 0) {
    btnPrev.style.display = "none";
  } else {
    btnPrev.style.display = "block";
  }


  btnNext.addEventListener("click", () => {
    let allInputPerTab = allTab[currentTab].querySelectorAll("input");
    for (let i = 0; i < allInputPerTab.length; i++) {
      if (!allInputPerTab[i].checkValidity()) {
        allInputPerTab[i].reportValidity();
        return false;
      }
    }
    //MOT DE PASSE
    if (currentTab == 3) {
      if (allTab[3].querySelectorAll("input")[0].value != allTab[3].querySelectorAll("input")[1].value) {
        allTab[3].querySelectorAll("input")[0].value = "";
        allTab[3].querySelectorAll("input")[1].value = "";
        alert("Les mots de passe ne correspondent pas");
        allTab[3].querySelectorAll("input")[0].reportValidity();
        return false;
      }
    }
    if (currentTab >= allTab.length - 1) {
      for (let i = 0; i < allTab.length; i++) {
        allInputPerTab = allTab[i].querySelectorAll("input");
        for (let j = 0; j < allInputPerTab.length; j++) {
          if (!allInputPerTab[j].checkValidity()) {
            for (let n = currentTab; n > i; n--) {
              allTab[n].classList.remove("show");
              indicatorItems[n].classList.remove("active");
            }
            currentTab = i;
            allTab[currentTab].classList.add("show");
            indicator.style.width = currentTab * 25 + "%";
            allInputPerTab[j].reportValidity();
            return false;
          }
        }
      }
      form.requestSubmit();
      return false;
    }
    else {
      currentTab++;
      for (let i = 0; i < allTab.length; i++) {
        allTab[i].classList.remove("show");
        indicatorItems[i].classList.remove("active");
      }

      for (let i = 0; i < currentTab; i++) {
        indicatorItems[i].classList.add("active");
      }
      allTab[currentTab].classList.add("show");
      indicator.style.width = currentTab * 25 + "%";
      indicatorItems[currentTab].classList.add("active");

    }

    if (currentTab == 0) {
      btnPrev.style.display = "none";
    } else {
      btnPrev.style.display = "block";
    }

    if (currentTab === allTab.length - 1) {
      btnNext.innerHTML = "Envoyer";
    } else {
      btnNext.innerHTML = "Suivant";
    }
  });

  btnPrev.addEventListener("click", () => {
    currentTab--;

    if (currentTab < 0) {
      currentTab = 0;
    }
    else {
      for (let i = 0; i < allTab.length; i++) {
        allTab[i].classList.remove("show");
        indicatorItems[i].classList.remove("active");
      }

      for (let i = 0; i < currentTab; i++) {
        indicatorItems[i].classList.add("active");
      }
      allTab[currentTab].classList.add("show");
      indicator.style.width = currentTab * 25 + "%";
      indicatorItems[currentTab].classList.add("active");
    }

    if (currentTab == 0) {
      btnPrev.style.display = "none";
    } else {
      btnPrev.style.display = "block";
    }

    if (currentTab === allTab.length - 1) {
      btnNext.innerHTML = "Envoyer";
    } else {
      btnNext.innerHTML = "Suivant";
    }
  });
});
