const id_topic = document.querySelector(".h2").id;

fetch(`/api/admin/exam/topic/${id_topic}`)
    .then(response => response.json())
    .then(result => Create_form_for_cards(result));

function Add_field_answer(event){
    event.preventDefault();
    const answers = event.target.closest("li");
    const li = document.createElement('li');
    li.innerHTML = `<input type="text" class="inp_answer" placeholder="Ответ..."><input type="number" class="inp_score" placeholder="Балл"></input>`;
    answers.insertAdjacentElement("beforebegin", li);
}

function Add_card_question(event){
    const card_question = `
    <div class="question">
      <textarea type="text" class="textarea_question" placeholder="Вопрос..."></textarea>
    </div>
    <ul class="answers" id="answers_1">
      <li class="li_inp"><input type="text" class="inp_answer" placeholder="Ответ..."><input type="number" class="inp_score" placeholder="Балл"></li>
      <li class="li_inp"><input type="text" class="inp_answer" placeholder="Ответ..."><input type="number" class="inp_score" placeholder="Балл"></li>
      <li><button class="btn_answers" onclick="Add_field_answer(event)">+ Добавить ответ</button></li>
    </ul>
      `;

    const questions = event.target;
    const div = document.createElement("form");
    div.classList.add("card_question");
    div.innerHTML = card_question;
    questions.insertAdjacentElement("beforebegin", div);
}

function Add_field_topic(event){
    const card_topic = `
      <div class="topic">
        <input type="text" placeholder="Тема...">
      </div>
      <div class="container_card_topic">
        <button class="add_card_question" onclick="Add_card_question(event)">
          <div class="container_card_btn">
            + Создать вопрос
          </div>
        </button>
      </div>
  `;

    const topic_btn = event.target;
    const div = document.createElement("div");
    div.classList.add("card_topic");
    div.innerHTML = card_topic;
    topic_btn.insertAdjacentElement("beforebegin", div);
}

function Create_form_for_cards(data_cards){

    let container = document.querySelector(".container_card_topic");
    const btn_add_question = document.querySelector(".add_card_question");

    const questions = [];

    data_cards.data.questions.forEach((item, index)=>{

        let question = `
      <div class="question" id="${item.id}">
        <textarea type="text" class="textarea_question" placeholder="Вопрос...">${item.question_text}
        </textarea>
      </div>
    `;

        let answers = [];

        item.options.forEach((item_2)=>{
            let answer = `
          <li class="li_inp">
            <input type="text" class="inp_answer" placeholder="Ответ..." value="${item_2.option_text}">
            <input type="number" class="inp_score" placeholder="Балл" value="${item_2.score}">
          </li>
      `;
            answers.push(answer);
        });

        let question_answers = `
      <form class="card_question">
        ${question}
        <ul class="answers">
          ${answers.join("")}
          <li><button class="btn_answers" onclick="Add_field_answer(event)">+ Добавить ответ</button></li>
        </ul>
      </form>
    `;
        questions.push(question_answers);

    });

    questions.forEach((item_3)=>{
        let card_topic = document.createElement("form");
        card_topic.classList.add("card_question");
        card_topic.innerHTML = item_3;
        container.insertBefore(card_topic, btn_add_question);
    });
}
