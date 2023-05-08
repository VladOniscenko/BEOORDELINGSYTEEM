//let studentToevoegKnop = document.getElementById("studentToevoegKnop");
let hiddenContainer = document.getElementsByClassName("hiddenContainer");

//studentToevoegKnop.addEventListener("click", hideToevoegContainer);
function hideToevoegContainer(containerId) {
    console.log(hiddenContainer[containerId].style.display)
    if (hiddenContainer[containerId].style.display === "none" || hiddenContainer[containerId].style.display === "") {
        hiddenContainer[containerId].style.display = "block";
      } else {
        hiddenContainer[containerId].style.display = "none";
        console.log("display set to none");
      }
  }

  function confirmOnClick(link){
    if (confirm("Weet je het zeker?") == true){
      window.location.href = link;
    }
  }