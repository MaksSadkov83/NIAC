let id = document.querySelector(".exam").id;

fetch(`/api/exam_start/${id}`)
  .then(response => response.json())
  .then(result => Create_exam(result))

function Create_exam(result){
  const ul = document.querySelector("#questions_menu");
  const slides = document.querySelector(".slides");
  const fr = document.createDocumentFragment();
  const fr_2 = document.createDocumentFragment();
  console.log(result[1])
  result[1].forEach((element, index) => {
    const li_q = document.createElement('li');
    li_q.append(element.question_text);
    li_q.id = `question_${index+1}`;
    fr.appendChild(li_q);

    const li_answers = [];

    element.options.forEach(element_2 => {
      const li_answer = `<li><input type="radio" name="answer" id="${element_2.id}"><label for="${element_2.id}">${element_2.option_text}</label></li>`;
      li_answers.push(li_answer);
    })

    let slide = document.createElement("div");
    slide.className = ` slide slide_${index+1}`;
    slide.id = element.id;

    let content_slide = `
      <div class="container_slide">
        <div class="text_question">
          ${element.question_text}
        </div>
        <ul class="list_answer">
          ${li_answers.join("")}
        </ul>
      </div>`;

    slide.innerHTML = content_slide;

    fr_2.appendChild(slide);
  });

  slides.append(fr_2);
  ul.appendChild(fr);
}

function Send_result_exam(){
  let form = document.querySelector(".form_slide");
  fetch("/api/result_exam", {
    method: "POST",
    body: new FormData(form)
  })
}
