function Collect_json(){

    const arr_data = [];

    let cards_question = document.querySelectorAll(".card_question");

    cards_question.forEach((item)=>{

        const arr_options = [];

        item.querySelectorAll(".li_inp").forEach((item)=>{

            let name_option = item.querySelector(".inp_answer").value;
            let score = item.querySelector(".inp_score").value;

            const temp_data = {
                name_option: name_option,
                score: score
            };

            arr_options.push(temp_data);
        });

        const data = {
            id_topic: document.querySelector("h2").id,
            name_question: item.querySelector(".textarea_question").value,
            options: arr_options
        };

        arr_data.push(data);
    });

    return arr_data;
}

function Send_json(){

    fetch("/api/admin/exam/topic", {
        method: "POST",
        headers: {
            "Content-Type": "application/json;charset=utf-8"
        },
        body: JSON.stringify(Collect_json())
    })
        .then(response => response.json())
        .then(result => alert(result))

}
