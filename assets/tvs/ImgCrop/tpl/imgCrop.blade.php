<div class="cropper">
  <input type="text" id="tv{{ $data['id'] }}" name="tv{{ $data['id'] }}" value="{{ $data['value'] }}"
    class="cropper__input"
    data-aspectRatio="{{ $data['aspectratio']}}"
    data-format="{{ $data['format']}}"
    data-bgcolor="{{ $data['bgcolor']}}"
    >
  <input type="button" value="Вставить" onclick="BrowseServer('tv{{ $data['id'] }}')">
  <div class="cropper__wrap">
    <div class="cropper__body"><img src="/{{ $data['value'] }}" alt="" class="img-crop"></div>
    <div class="imgcrop-action">
      <button class="imgcrop-btn imgcrop-cropper" title="Кадрировать изображение">
        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
          <path
            d="M680-40v-160H280q-33 0-56.5-23.5T200-280v-400H40v-80h160v-160h80v640h640v80H760v160h-80Zm0-320v-320H360v-80h320q33 0 56.5 23.5T760-680v320h-80Z" />
        </svg>
      </button>
      <button class="imgcrop-btn imgcrop-save" title="Сохранить кадрирование">
        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
          <path
            d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h480l160 160v212q-19-8-39.5-10.5t-40.5.5v-169L647-760H200v560h240v80H200Zm0-640v560-560ZM520-40v-123l221-220q9-9 20-13t22-4q12 0 23 4.5t20 13.5l37 37q8 9 12.5 20t4.5 22q0 11-4 22.5T863-260L643-40H520Zm300-263-37-37 37 37ZM580-100h38l121-122-18-19-19-18-122 121v38Zm141-141-19-18 37 37-18-19ZM240-560h360v-160H240v160Zm240 320h4l116-115v-5q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35Z" />
        </svg>
      </button>
      <button class="imgcrop-btn imgcrop-cancel" title="Отменить">
        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
          <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
        </svg>
      </button>
    </div>
  </div>
  {!! $data['js'] !!}
  {!! $data['css'] !!}
</div>
