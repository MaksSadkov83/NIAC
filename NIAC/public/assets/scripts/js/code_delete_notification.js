const btn = document.querySelector(".delete_notification");
const notification = document.querySelector(".notification");

btn.addEventListener("click", (event)=>{
  console.log(123);
  notification.style.display = "none";
});