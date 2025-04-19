;(function ($) {
  'use strict'
  var HT = {}
  var document = $(document)

  HT.switchery = () => {
    $('.js-switch').each(function () {
      var switchery = new Switchery(this, { color: '#1AB394' })
    })
  }
  document.ready(function () {
    HT.switchery()
  })
})(jQuery)

document.addEventListener('DOMContentLoaded', function () {
  var deleteButton = document.getElementById('deleteUserButton')

  if (deleteButton) {
    deleteButton.addEventListener('click', function () {
      if (confirm('Bạn có chắc chắn muốn xoá?')) {
      } else {
      }
    })
  }
})

function submitGroupForm() {
  document.getElementById('group-form').submit()
}

document.getElementById('perpage').addEventListener('change', function () {
  document.getElementById('perpage-form').submit()
})

document.addEventListener('DOMContentLoaded', function () {
  const showFormButton = document.getElementById('showAddUserForm')
  const addUserForm = document.getElementById('addUserForm')
  const overlay = document.getElementById('overlay')
  const cancelFormButton = document.getElementById('cancelAddUserForm')

  showFormButton.addEventListener('click', function () {
    addUserForm.classList.add('show')
    addUserForm.classList.remove('hide')
    overlay.style.display = 'block' // Hiển thị lớp phủ
    showFormButton.style.display = 'none' // Ẩn nút thêm
  })

  cancelFormButton.addEventListener('click', function () {
    addUserForm.classList.add('hide')
    addUserForm.classList.remove('show')
    overlay.style.display = 'none' // Ẩn lớp phủ
    showFormButton.style.display = 'inline-block' // Hiện lại nút thêm
  })

  // Khi nhấn vào lớp phủ thì cũng đóng form
  overlay.addEventListener('click', function () {
    addUserForm.classList.add('hide')
    addUserForm.classList.remove('show')
    overlay.style.display = 'none' // Ẩn lớp phủ
    showFormButton.style.display = 'inline-block' // Hiện lại nút thêm
  })
})
