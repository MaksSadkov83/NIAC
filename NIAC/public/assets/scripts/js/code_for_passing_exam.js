let count_slide = 1;
let position_slides = 0;

const slides = document.querySelector('.slides');

const question_number = document.querySelector('#question_number');

function Delay(event){
  let answer_function = Change_color_question_pagination();

  if(answer_function){
    document.querySelector(`#question_${count_slide}`).style.color = "#bdbdbd";
  }

  if(event.target.id == "next_btn"){
    count_slide++;
    const slide = document.querySelector('.slide');
    position_slides = position_slides - window.getComputedStyle(slide).width.slice(-0, -2);
    slides.style.left = `${position_slides}px`;
  }else{
    count_slide--;
    const slide = document.querySelector('.slide');
    position_slides = position_slides + parseInt(window.getComputedStyle(slide).width.slice(-0, -2));
    console.log(position_slides);
    slides.style.left = `${position_slides}px`;
  }
  question_number.textContent = `${count_slide} / 30`;
}

function Change_color_question_pagination(){
  let slide_id = document.querySelector(`.slide_${count_slide}`);
  console.log(slide_id)
  let result = false;
  slide_id.querySelectorAll("input").forEach((item)=>{
      console.log(item.checked)
    if(item.checked == true){ result = true };
  });
  console.log(result);
  return result;
}
