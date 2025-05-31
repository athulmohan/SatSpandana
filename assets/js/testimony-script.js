
// $(document).ready(function() {
//     const maxWords = 50;
//     $('#testimony_textarea').on('input', function() {

//         let text = $(this).val().trim();
//         let words = text.split(/\s+/);

//         if (text.length === 0) {
//             $('#wordCountMessage').text('');
//         } else if (words.length > maxWords) {
//             // Block typing beyond 50 words
//             // $(this).val(words.slice(0, maxWords).join(' '));
//             $('#wordCountMessage').text('Maximum ' + maxWords + ' words reached.');
//             this.blur();
//         } else {
//             $('#wordCountMessage').text(words.length + ' / ' + maxWords + ' words');
//         }
//     });
// });
