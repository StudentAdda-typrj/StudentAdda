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