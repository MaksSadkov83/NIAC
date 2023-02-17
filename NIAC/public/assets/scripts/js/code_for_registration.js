const btn_reg_avto = document.querySelector(".btn_reg_avto");
const two_forms = document.querySelector(".two_form");
const btn_avto_reg_text = document.querySelector(".btn_avto_reg_text");

const mas_svg = ["../public/assets/svg/avto.svg", "../public/assets/svg/reg.svg"];
let deg = 0;
let click_count = 0;

function Rotate(){
  two_forms.style.transform = `rotate(${deg -= 180}deg)`;
  document.querySelector("#svg_reg_avto").src = mas_svg[click_count == 1 ? --click_count : ++click_count];
}

btn_avto_reg_text.addEventListener('click', Rotate);
