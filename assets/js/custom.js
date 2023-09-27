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
  const ram = document.getElementById('ram');
  const connector_type = document.getElementById('connector_type');

  sub_category.addEventListener('change', function() {
    if (this.value === '1' || this.value === '5' || this.value === '6') {
      processor.disabled = false;
    } else{
      processor.value = '';
      processor.disabled = true;
    }
    if (this.value === '1' || this.value === '4' || this.value === '6') {
      screen_size.disabled = false;
    } else{
      screen_size.value = '';
      screen_size.disabled = true;
    }
    if (this.value === '1' || this.value === '5' || this.value === '6') {
      ram.disabled = false;
    } else{
      ram.value = '';
      ram.disabled = true;
    }
    if (this.value === '2' || this.value === '3') {
      connector_type.disabled = false;
    } else{
      connector_type.value = '';
      connector_type.disabled = true;
    }
  });
});

//User profile Image upload preview
const profile_image = document.querySelector("img");
const profile_input =document.querySelector('input[name="profile_url"]');

profile_input.addEventListener("change", () => {
    profile_image.src = URL.createObjectURL(profile_input.files[0]);
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

function getFrontImagePreview (event) {
  var photo_url = URL.createObjectURL(event.target.files[0]);
  var preview_container = document.getElementById('front_image_preview');
  var new_image = document.createElement('img');

  preview_container.innerHTML = '';
  new_image.src = photo_url;
  new_image.width = "300";
  new_image.height = "200";
  preview_container.appendChild(new_image);
}

function getSecondImagePreview (event) {
  var photo_url2 = URL.createObjectURL(event.target.files[0]);
  var preview_container = document.getElementById('second_image_preview');
  var new_image = document.createElement('img');

  preview_container.innerHTML = '';
  new_image.src = photo_url2;
  new_image.width = "300";
  new_image.height = "200";
  preview_container.appendChild(new_image);
}

function getFinalFrontImagePreview (event) {
  var photo_url = URL.createObjectURL(event.target.files[0]);
  var preview_container = document.getElementById('final_front_image_preview');
  var new_image = document.createElement('img');

  preview_container.innerHTML = '';
  new_image.src = photo_url;
  new_image.width = "300";
  new_image.height = "200";
  preview_container.appendChild(new_image);
}

function getFinalSecondImagePreview (event) {
  var photo_url2 = URL.createObjectURL(event.target.files[0]);
  var preview_container = document.getElementById('final_second_image_preview');
  var new_image = document.createElement('img');

  preview_container.innerHTML = '';
  new_image.src = photo_url2;
  new_image.width = "300";
  new_image.height = "200";
  preview_container.appendChild(new_image);
}

document.addEventListener('DOMContentLoaded', function() {
  const duration_in_month = document.getElementById('duration');
  const rent_price = document.getElementById('price');
  const rentItemLink = document.getElementById('pay_for_rent'); // Get the anchor tag by id

  duration_in_month.addEventListener('input', function() {
      // Get the selected duration_in_month value and parse it as a number
      const selectedDuration = parseFloat(duration_in_month.value);

      // Get the current rent_price value and parse it as a number
      const currentPrice = parseFloat(rent_price.value);

      // Check if both values are valid numbers
      if (!isNaN(selectedDuration) && !isNaN(currentPrice)) {

      // Update the href attribute of the anchor tag with the new URL including the duration as a query parameter
        rentItemLink.href = `/payment/rent_item_address.php?q=<?php echo $book["id"];?>&r=<?php echo $type;?>&s=${selectedDuration}`;
      }
  });
});
