<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link href="{{ asset('css/chat.css') }}" rel="stylesheet">
    {{-- <link href="{{ secure_asset('css/chat.css') }}" rel="stylesheet"> --}}

    <script src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>

    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

  </head>
  <body>
    <section class="msger">
        <header class="msger-header">
          <div class="msger-header-title">
            <i class="fas fa-comment-alt"></i> OJT Chatbot Helper
          </div>
        </header>

        <main class="msger-chat">
          <div class="msg left-msg">
            <div class="msg-bubble">
              <div class="msg-info">
                <div class="msg-info-name">Ccis Bot</div>
              </div>

              <div class="msg-text">
                I'm Ccis Bot! Your 24/7 digital assistant ready to provide information as much we can.
              </div>
            </div>
          </div>

          <div class="msg right-msg">

          </div>
        </main>
        <form class="msger-inputarea">
          <input type="text" class="msger-input" placeholder="Enter your message...">
          <button type="submit" class="msger-send-btn">Send</button>
        </form>
      </section>
  </body>
</html>

<script>

const msgerForm = get(".msger-inputarea");
const msgerInput = get(".msger-input");
const msgerChat = get(".msger-chat");

const BOT_NAME = "Ccis Bot";
const PERSON_NAME = "You";

msgerForm.addEventListener("submit", event => {
    event.preventDefault();

    const msgText = msgerInput.value;
    if (!msgText) return;

    appendMessage(PERSON_NAME, "right", msgText);
    msgerInput.value = "";
    var response = msgText;
    botResponse(response);
});

function appendMessage(name, side, text) {

  const msgHTML = `
    <div class="msg ${side}-msg">
      <div class="msg-bubble">
        <div class="msg-info">
          <div class="msg-info-name">${name}</div>
        </div>

        <div class="msg-text">${text}</div>
      </div>
    </div>
  `;

  msgerChat.insertAdjacentHTML("beforeend", msgHTML);
  msgerChat.scrollTop += 500;
}

function botResponse(response) {
    message = response;
    $.ajax({
        type: "GET",
        url: "/chatbot/" + message + "",
        data: {
            message: message,
        },
        success: function (response) {
            console.log(response);
            appendMessage(BOT_NAME, "left", response);
        },
    });
}

function get(selector, root = document) {
  return root.querySelector(selector);
}

</script>
