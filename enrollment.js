const collegeSelect = document.getElementById("college-select");
const programSelect = document.getElementById("program-select");

const engineeringPrograms = ["Civil", "Computer", "Industrial", "Mechanical"];
const computingPrograms = ["Computer Science", "Information Technology", "Information Systems"];

collegeSelect.addEventListener("change", () => {
    programSelect.innerHTML = "";
    
    if (collegeSelect.value == "1") {
        let defaultOption = document.createElement("option");
        defaultOption.text = "- Please select a program -";
        defaultOption.setAttribute("selected", true);
        defaultOption.setAttribute("disabled", true);
        programSelect.add(defaultOption);
        computingPrograms.forEach((program) => {
            let option = document.createElement("option");
            option.text = program;
            option.setAttribute("value", program);
            programSelect.add(option);
        })
    } else if (collegeSelect.value == "2") {
        let defaultOption = document.createElement("option");
        defaultOption.text = "- Please select a program -";
        defaultOption.setAttribute("selected", true);
        defaultOption.setAttribute("disabled", true);
        programSelect.add(defaultOption);
        engineeringPrograms.forEach((program) => {
            let option = document.createElement("option");
            option.text = program + " Engineering";
            option.setAttribute("value", option.text);
            programSelect.add(option);
        })
    }
});

