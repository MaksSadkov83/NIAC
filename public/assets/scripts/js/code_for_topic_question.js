function Add_field_answer(event){
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
      <li><input type="text" class="inp_answer" placeholder="Ответ..."><input type="number" class="inp_score" placeholder="Балл"></li>
      <li><input type="text" class="inp_answer" placeholder="Ответ..."><input type="number" class="inp_score" placeholder="Балл"></li>
      <li><button class="btn_answers" onclick="Add_field_answer(event)">+ Добавить ответ</button></li>
    </ul>
      `;

  const questions = event.target;
  const div = document.createElement("div");
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
            + Создать карточку
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
