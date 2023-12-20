
// 숫자만 입력 가능.
function numberInput(inputElement) {
    var inputValue = inputElement.value;
    console.log(inputValue);

    if (!/^[0-9]*$/.test(inputValue)) {
        // 숫자가 아닌 문자를 입력한 경우
        inputValue = inputValue.replace(/[^0-9]/g, ""); // 숫자 이외의 문자 제거
        alert("숫자만 입력해주세요.");
        
        // 변경된 값을 입력 필드에 다시 넣어줍니다.
        inputElement.value = inputValue;
    }
    console.log(inputValue);
}

    