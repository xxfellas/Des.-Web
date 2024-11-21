document.addEventListener("DOMContentLoaded", function () {
    const formViagem = document.getElementById("formViagem");
    const formDespesa = document.getElementById("formDespesa");
    const tabelaViagens = document.getElementById("tabelaViagens");
    const tabelaDespesas = document.getElementById("tabelaDespesas");
    const viagemSelect = document.getElementById("viagem");

    let viagens = [];
    let despesas = [];

    formViagem.addEventListener("submit", async function (event) {
        event.preventDefault();

        const nomeViagem = document.getElementById("nomeViagem").value;
        const destino = document.getElementById("destino").value;
        const dataInicio = document.getElementById("dataInicio").value;
        const dataFim = document.getElementById("dataFim").value;

        const novaViagem = { 
            name: nomeViagem, 
            location: destino, 
            start_date: dataInicio,
            end_date: dataFim 
        };
        console.log(novaViagem)
        let options = {
            method: 'POST',
            body: novaViagem
        }
        const response = await fetch('http://localhost:8000/trips', options)
        const data = await response.json()
        console.log(data)


        viagens.push(novaViagem);

        atualizarTabelaViagens();
        atualizarSelectViagens();
        formViagem.reset();
    });

    formDespesa.addEventListener("submit", async (event) => {
        event.preventDefault();

        const viagemIndex = viagemSelect.value;
        const viagem = viagens[viagemIndex].nomeViagem;
        const categoria = document.getElementById("categoria").value;
        const valor = parseFloat(document.getElementById("valor").value);
        const novaDespesa = { viagem, categoria, valor };

        despesas.push(novaDespesa);

        atualizarTabelaDespesas();
        formDespesa.reset();
    });

    function atualizarTabelaViagens() {
        tabelaViagens.innerHTML = "";
        viagens.forEach((viagem, index) => {
            const row = document.createElement("tr");
            row.innerHTML = `
          <td>${viagem.nomeViagem}</td>
          <td>${viagem.destino}</td>
          <td>${viagem.dataInicio}</td>
          <td>${viagem.dataFim}</td>
          <td>
            <button class="btn btn-warning btn-sm" onclick="editarViagem(${index})">Editar</button>
            <button class="btn btn-danger btn-sm" onclick="excluirViagem(${index})">Excluir</button>
          </td>
        `;
            tabelaViagens.appendChild(row);
        });
    }

    function atualizarTabelaDespesas() {
        tabelaDespesas.innerHTML = "";
        despesas.forEach((despesa, index) => {
            const row = document.createElement("tr");
            row.innerHTML = `
          <td>${despesa.viagem}</td>
          <td>${despesa.categoria}</td>
          <td>R$ ${despesa.valor.toFixed(2)}</td>
          <td>
            <button class="btn btn-warning btn-sm" onclick="editarDespesa(${index})">Editar</button>
            <button class="btn btn-danger btn-sm" onclick="excluirDespesa(${index})">Excluir</button>
          </td>
        `;
            tabelaDespesas.appendChild(row);
        });
    }

    function atualizarSelectViagens() {
        viagemSelect.innerHTML = '<option selected>Escolha uma viagem</option>';
        viagens.forEach((viagem, index) => {
            const option = document.createElement("option");
            option.value = index;
            option.text = viagem.nomeViagem;
            viagemSelect.add(option);
        });
    }

    window.editarViagem = function (index) {
        const viagem = viagens[index];
        document.getElementById("nomeViagem").value = viagem.nomeViagem;
        document.getElementById("destino").value = viagem.destino;
        document.getElementById("dataInicio").value = viagem.dataInicio;
        document.getElementById("dataFim").value = viagem.dataFim;

        formViagem.onsubmit = function (event) {
            event.preventDefault();

            viagens[index] = {
                nomeViagem: document.getElementById("nomeViagem").value,
                destino: document.getElementById("destino").value,
                dataInicio: document.getElementById("dataInicio").value,
                dataFim: document.getElementById("dataFim").value,
            };

            atualizarTabelaViagens();
            atualizarSelectViagens();
            formViagem.reset();
            formViagem.onsubmit = defaultCadastroHandler;
        };
    };

    window.excluirViagem = function (index) {
        viagens.splice(index, 1);
        atualizarTabelaViagens();
        atualizarSelectViagens();
    };

    window.editarDespesa = function (index) {
        const despesa = despesas[index];
        viagemSelect.value = viagens.findIndex(v => v.nomeViagem === despesa.viagem);
        document.getElementById("categoria").value = despesa.categoria;
        document.getElementById("valor").value = despesa.valor;

        formDespesa.onsubmit = function (event) {
            event.preventDefault();

            despesas[index] = {
                viagem: viagens[viagemSelect.value].nomeViagem,
                categoria: document.getElementById("categoria").value,
                valor: parseFloat(document.getElementById("valor").value),
            };

            atualizarTabelaDespesas();
            formDespesa.reset();
            formDespesa.onsubmit = defaultDespesaHandler;
        };
    };

    window.excluirDespesa = function (index) {
        despesas.splice(index, 1);
        atualizarTabelaDespesas();
    };

    const defaultCadastroHandler = formViagem.onsubmit;
    const defaultDespesaHandler = formDespesa.onsubmit;
});
