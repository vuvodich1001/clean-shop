// function borderWhenChecked() {
//     let inputRadios = document.querySelectorAll('input[type="radio"]');
//     let addressGroups = document.querySelectorAll('.address-group');
//     if (inputRadios) {
//         inputRadios.forEach(inputRadio => {
//             inputRadio.addEventListener('click', e => {
//                 addressGroups.forEach(addressGroup => {
//                     addressGroup.style.border = 'none';
//                 })
//                 let addressGroup = inputRadio.parentElement;
//                 if (inputRadio.checked == true) {
//                     addressGroup.style.border = '2px solid #5045E6';
//                 }
//             })
//         })
//     }
// }

// function start() {
//     borderWhenChecked();
// }

// start();