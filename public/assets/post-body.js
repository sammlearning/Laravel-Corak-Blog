var multipleCancelButton = new Choices('#postCategory', {
  removeItemButton: true,
  // maxItemCount:5,
  // searchResultLimit:5,
  // renderChoiceLimit:5
});

var colors = [
  '#00a8ff', '#9c88ff', '#fbc531', '#4cd137', '#487eb0', '#0097e6',
  '#8c7ae6', '#e1b12c', '#44bd32', '#40739e', '#e84118', '#f5f6fa',
  '#7f8fa6', '#273c75', '#353b48', '#c23616', '#dcdde1', '#718093',
  '#192a56', '#2f3640', '#40407a', 'color-picker'
];

var quill = new Quill('#postBody', {
  theme: 'snow',
  modules: {
    toolbar: [
      [{ header: [1, 2, 3, 4, false] }],
      ['bold', 'italic'],
      ['link', 'blockquote', 'code-block'],
      ['underline', 'strike'],
      [{ 'color': colors }],
      [{ 'background': colors }],
      [{ list: 'ordered' }, { list: 'bullet' }]
    ]
  }
});

function showColorPicker(value) {
  if (value === 'color-picker') {
    var picker = document.getElementById('color-picker');
  if (!picker) {
    picker = document.createElement('input');
    picker.id = 'color-picker';
    picker.type = 'color';
    picker.style.display = 'none';
    picker.value = '#FF0000';
    document.body.appendChild(picker);

    picker.addEventListener('change', function() {
      quill.format('color', picker.value);
    }, false);
  }
  picker.click();
  } else {
    quill.format('color', value);
  }
}

var toolbar = quill.getModule('toolbar');
toolbar.addHandler('color', showColorPicker);
