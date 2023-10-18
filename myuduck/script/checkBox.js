const agreeCheck1 = document.querySelector(".check input[name='agreeCheck1']");
const agreeCheck2 = document.querySelector(".check input[name='agreeCheck2']");
const agreeCheck3 = document.querySelector(".check input[name='agreeCheck3']");
const agreeCheck4 = document.querySelector(".check input[name='agreeCheck4']");

// 여기서 agreeCheck1.checked를 확인하여 초기 상태를 확인합니다.
if (agreeCheck1 && agreeCheck1.checked) {
    agreeCheck2.checked = true;
    agreeCheck3.checked = true;
    agreeCheck4.checked = true;
}
