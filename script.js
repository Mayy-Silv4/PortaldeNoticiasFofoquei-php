function buscarClima() {

  const apiKey = "42fb20e3f20b5a2b3609f92daab6ea0f"; // coloque sua chave aqui
  const cidade = document.getElementById("cidadeInput").value;

  if (cidade === "") {
    alert("Digite uma cidade!");
    return;
  }

  const url = `https://api.openweathermap.org/data/2.5/weather?q=${cidade}&appid=${apiKey}&units=metric&lang=pt_br`;

  fetch(url)
    .then(response => {
      if (!response.ok) {
        throw new Error("Cidade não encontrada");
      }
      return response.json();
    })
    .then(data => {

      const temp = data.main.temp;
      const clima = data.weather[0].description;
      const tipoClima = data.weather[0].main;

      let emoji = "☀️";

      if (tipoClima === "Clouds") emoji = "☁️";
      if (tipoClima === "Rain") emoji = "🌧";
      if (tipoClima === "Clear") emoji = "☀️";
      if (tipoClima === "Thunderstorm") emoji = "⛈";

      document.getElementById("temperatura").innerText =
        `🌡 ${temp}°C`;

      document.getElementById("descricao").innerText =
        `${emoji} ${clima}`;

    })
    .catch(error => {
      alert("Erro ao buscar clima. Verifique a cidade ou a API.");
      console.log(error);
    });
}


function toggleTema() {
  document.body.classList.toggle("dark");

  const btn = document.getElementById("themeBtn");

  if (document.body.classList.contains("dark")) {
    localStorage.setItem("tema", "dark");
    if (btn) btn.innerHTML = "☀️";
  } else {
    localStorage.setItem("tema", "light");
    if (btn) btn.innerHTML = "🌙";
  }
}

window.addEventListener("load", function () {
  const tema = localStorage.getItem("tema");
  const btn = document.getElementById("themeBtn");

  if (tema === "dark") {
    document.body.classList.add("dark");
    if (btn) btn.innerHTML = "☀️";
  } else {
    if (btn) btn.innerHTML = "🌙";
  }
});


window.addEventListener("load", function () {
  const icone = document.querySelector(".clima-icone");
  const box = document.querySelector(".clima-box");

  if (!icone || !box) return;

  icone.addEventListener("click", function (e) {
    e.stopPropagation();
    box.classList.toggle("ativo");
  });

  document.addEventListener("click", function () {
    box.classList.remove("ativo");
  });
});

