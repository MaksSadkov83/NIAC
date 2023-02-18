/* Save question_options */

function Collect_json(){

    const arr_data = [];

    let cards_question = document.querySelectorAll(".new");

    if(cards_question.length == 0){
        return [];
    }

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

    const json = Collect_json();

    if(json.length == 0){
        return;
    }

    fetch("/api/admin/exam/topic", {
        method: "POST",
        headers: {
            "Content-Type": "application/json;charset=utf-8"
        },
        body: JSON.stringify(json)
    })
        .then(response => response.json())
        .then(result => alert(result))

}

/* Update question */

function Collect_json_update(){

    const arr_data = [];

    let cards_question = document.querySelectorAll(".update");

    if(cards_question.length == 0){
        return [];
    }

    cards_question.forEach((item)=>{

        const arr_options = [];

        item.querySelectorAll(".li_inp").forEach((item)=>{

            let name_option = item.querySelector(".inp_answer").value;
            let score = item.querySelector(".inp_score").value;

            const temp_data = {
                id_option: item.id,
                name_option: name_option,
                score: score
            };

            arr_options.push(temp_data);
        });

        const data = {
            id_question: item.querySelector(".question").id,
            name_question: item.querySelector(".textarea_question").value,
            options: arr_options
        };

        arr_data.push(data);
    });

    return arr_data;
}

function Send_json_update(){

    const json = Collect_json_update();

    if(json.length == 0){
        return;
    }

    fetch(`/api/admin/exam/topic/1`, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json;charset=utf-8"
        },
        body: JSON.stringify(json)
    })
        .then(response => response.json())
        .then(result => alert(result))

}

/* Save options */

function Collect_json_save_options(){

    let options = document.querySelectorAll(".new_option");

    if(options.length == 0){
        return [];
    }

    const arr_data = [];

    options.forEach((item)=>{

        let name_option = item.querySelector(".inp_answer").value;
        let score = item.querySelector(".inp_score").value;

        const temp_data = {
            id_question: item.closest(".answers").previousElementSibling.id,
            name_option: name_option,
            score: score
        };

        arr_data.push(temp_data);
    });

    return arr_data;
}

function Send_json_save_options(){

    const json = Collect_json_save_options();

    if(json.length == 0){
        return console.log("Нечего обновлять");
    }

    fetch(`/api/admin/exam/topic/question/option/`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json;charset=utf-8"
        },
        body: JSON.stringify(json)
    })
        .then(response => response.json())
        .then(result => alert(result))

}

/* Start send */

function Send(){
    Send_json_update();
    Send_json();
    Send_json_save_options();
}
