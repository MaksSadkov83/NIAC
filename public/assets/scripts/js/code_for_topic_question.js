let id_exam = document.querySelector(".h2").id;

fetch(`/api/admin/exam/${id_exam}`)
  .then(response => response.json())
  .then(result => Create_form_for_cards(result));

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

    let container = document.querySelector(".container_for_card");

    if(data_cards.data.question_topics.length == 0){
        let base_topic = document.createElement('div');
        base_topic.innerHTML = `
            <div class="card_topic">
                <div class="topic">
                    <input type="text" placeholder="Тема...">
                </div>
            <div class="container_card_topic">
                <button class="add_card_question" onclick="Add_card_question(event)">
                    <div class="container_card_btn">
                        + Создать вопорос
                    </div>
                </button>
            </div>
            </div>
            <button class="create_card_topic" onclick="Add_field_topic(event)">
                + Создать тему
            </button>
        `;
        container.appendChild(base_topic);
    }


  const topics = [];

  data_cards.data.question_topics.forEach((item, index)=>{

    let topic = `
      <div class="topic" id="${item.id}">
        <input type="text" placeholder="Тема..." value="${item.question_topic_text}">
      </div>
    `;

    let questions = [];

    item.questions.forEach((item_2)=>{

      let question = `
        <div class="question" id="${item_2.id}">
          <textarea type="text" class="textarea_question" placeholder="Вопрос...">${item_2.question_text}
          </textarea>
        </div>
      `;

      let answers = [];

      item_2.options.forEach((item_3, index)=>{
        let answer = `
          <li><input type="text" class="inp_answer" placeholder="Ответ..." value="${item_3.option_text}"><input type="number" class="inp_score" placeholder="Балл" value="${item_3.score}"></li>
        `;
        answers.push(answer);
      })

      let question_answers = `
        <div class="card_question">
          ${question}
          <ul class="answers">
            ${answers.join("")}
            <li><button class="btn_answers" onclick="Add_field_answer(event)">+ Добавить ответ</button></li>
          </ul>
        </div>
      `;

      questions.push(question_answers);
    });

    let topic_questions = `
      ${topic}
      <div class="container_card_topic">
        ${questions.join("")}
        <button class="add_card_question" onclick="Add_card_question(event)">
          <div class="container_card_btn">
            + Создать вопорос
          </div>
        </button>
      </div>
    `;

    topics.push(topic_questions);
  });

  topics.forEach((item_3)=>{
    let card_topic = document.createElement("div");
    card_topic.classList.add("card_topic");
    card_topic.innerHTML = item_3;
    container.appendChild(card_topic);
  });
}
