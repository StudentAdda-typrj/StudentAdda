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

//User profile Image upload preview
const profile_image = document.querySelector("img");
const profile_input =document.querySelector('input[name="profile_url"]');

profile_input.addEventListener("change", () => {
    profile_image.src = URL.createObjectURL(input.files[0]);
});

function getCoverImagePreview (event) {
  var cover_image = URL.createObjectURL(event.target.files[0]);
  var preview_container = document.getElementById('cover_image_preview');
  var new_image = document.createElement('img');

  preview_container.innerHTML = '';
  new_image.src = cover_image;
  new_image.width = "300";
  new_image.height = "200";
  preview_container.appendChild(new_image);
}

function getIndexImagePreview (event) {
  var index_image = URL.createObjectURL(event.target.files[0]);
  var preview_container = document.getElementById('index_image_preview');
  var new_image = document.createElement('img');

  preview_container.innerHTML = '';
  new_image.src = index_image;
  new_image.width = "300";
  new_image.height = "200";
  preview_container.appendChild(new_image);
}

function getFinalCoverImagePreview (event) {
  var cover_image = URL.createObjectURL(event.target.files[0]);
  var preview_container = document.getElementById('final_cover_image_preview');
  var new_image = document.createElement('img');

  preview_container.innerHTML = '';
  new_image.src = cover_image;
  new_image.width = "300";
  new_image.height = "200";
  preview_container.appendChild(new_image);
}

function getFinalIndexImagePreview (event) {
  var index_image = URL.createObjectURL(event.target.files[0]);
  var preview_container = document.getElementById('final_index_image_preview');
  var new_image = document.createElement('img');

  preview_container.innerHTML = '';
  new_image.src = index_image;
  new_image.width = "300";
  new_image.height = "200";
  preview_container.appendChild(new_image);
}