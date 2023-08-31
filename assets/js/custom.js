//For disabling and enabling the department section for book_type University Books
document.addEventListener('DOMContentLoaded', function() {
  const category = document.getElementById('book_type');
  const department = document.getElementById('department');

  category.addEventListener('change', function() {
    if (this.value === '5') {
      department.disabled = false;
    }
    else{
      department.value = '0';
      department.disabled = true;
    }
  });
});

//For disabling and enabling the processor, screen section for accessory_type CPU, Monitor respectively
document.addEventListener('DOMContentLoaded', function() {
  const sub_category = document.getElementById('accessory_type');
  const processor = document.getElementById('processor');
  const screen_size = document.getElementById('screen_size');

  sub_category.addEventListener('change', function() {
    if (this.value === '1' || this.value === '5' || this.value === '6') {
      processor.disabled = false;
    } else{
      processor.value = '';
      processor.disabled = true;
    }
    if (this.value === '4') {
      screen_size.disabled = false;
    } else{
      screen_size.value = '';
      screen_size.disabled = true;
    }
  });
});