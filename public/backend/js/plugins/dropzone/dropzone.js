document.addEventListener('DOMContentLoaded', function () {
  // Các ID của ảnh
  const imageInputs = [
    {
      id: 'productImage1',
      previewId: 'imagePreview1',
      removeBtnId: 'removeImageBtn1',
    },
    {
      id: 'productImage2',
      previewId: 'imagePreview2',
      removeBtnId: 'removeImageBtn2',
    },
    {
      id: 'productImage3',
      previewId: 'imagePreview3',
      removeBtnId: 'removeImageBtn3',
    },
    {
      id: 'productImage4',
      previewId: 'imagePreview4',
      removeBtnId: 'removeImageBtn4',
    },
  ]

  // Xử lý sự kiện cho mỗi ảnh
  imageInputs.forEach(function (input) {
    let fileInput = document.getElementById(input.id)
    let imagePreview = document.getElementById(input.previewId)
    let removeButton = document.getElementById(input.removeBtnId)

    // Khi chọn ảnh từ input
    fileInput.addEventListener('change', function (event) {
      let file = event.target.files[0]
      if (file) {
        let reader = new FileReader()
        reader.onload = function (e) {
          imagePreview.src = e.target.result
          imagePreview.style.display = 'block' // Hiển thị ảnh xem trước
          removeButton.style.display = 'inline-block' // Hiển thị nút xóa
        }
        reader.readAsDataURL(file)
      }
    })

    // Khi nhấn nút xóa
    removeButton.addEventListener('click', function () {
      imagePreview.src = '#'
      imagePreview.style.display = 'none'
      removeButton.style.display = 'none'
      fileInput.value = '' // Xóa tệp đã chọn
    })

    // Khi kéo thả ảnh vào khu vực dropzone
    let dropzone = document.getElementById(input.previewId).parentNode
    dropzone.addEventListener('click', function () {
      fileInput.click()
    })

    dropzone.addEventListener('dragover', function (event) {
      event.preventDefault()
    })

    dropzone.addEventListener('drop', function (event) {
      event.preventDefault()
      let files = event.dataTransfer.files
      if (files.length > 0) {
        fileInput.files = files // Gán tệp vào input
        fileInput.dispatchEvent(new Event('change'))
      }
    })
  })
})
