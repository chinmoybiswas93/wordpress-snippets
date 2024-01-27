var storedData = localStorage.getItem("code");
console.log(storedData);
// 	console.log(window.location.pathname);
// Check if the current URL is already '/validation'
if (window.location.pathname === "/validation/") {
  //     console.log("Already on /validation, no redirection needed.");
} else if (storedData === "true") {
  // do nothing
} else {
  // Redirect to '/validation'
  window.location.href = "/validation";
}
