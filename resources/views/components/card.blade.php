<div class="card">
    {{-- card banner / thumbnail --}}
    <div class="card__img-container">
        <img src="https://static.zerochan.net/Shiina.Mashiro.full.1607930.jpg" alt="sample image">
    </div>
    {{-- basic information: card title, label, subtitle, avatar_list, etc... --}}
    <div class="card__metadata">
        <span class="tag on-broadcast">Broadcast started: 28 mins ago.</span>
        <h1>{{ $title }}</h1>
        <time datetime="2022-12-15 08:00">{{ $message }}</time>
        <div class="avatar-list">
            <img src="https://static.zerochan.net/Shiina.Mashiro.full.1607930.jpg" alt="sample image">
            <img src="https://static.zerochan.net/Shiina.Mashiro.full.1607930.jpg" alt="sample image">
            <img src="https://static.zerochan.net/Shiina.Mashiro.full.1607930.jpg" alt="sample image">
            <p class="summary">+ 25 spectators</p>
        </div>
    </div>
    {{-- card action --}}
    <div class="card__action">
        <button class="primary" type="button">REQUEST JOIN</button>
        <button class="secondary" type="button">SCHEDULE</button>
    </div>
</div>
