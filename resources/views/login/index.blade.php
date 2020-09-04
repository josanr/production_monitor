@extends('layout.main')

@section("title")
    Login
@endsection

@section("content")
<style>
    #login-list div{
        cursor: pointer;
    }
</style>
<div id="workArea" style="width: 768px; height: 100%; margin: 0 auto;">
    <div class="" id="login-list">
    </div>
</div>


<script>
    "use strict";
    const client = new ApiClient();
    const Loginer = function () {
        this.groupList = [
            {groupId: 185, label: "Оптимизация"},
            {groupId: 122, label: "Распил"},
            {groupId: 123, label: "Доп. Обработка"},
            {groupId: 129, label: "Поклейка"},
            {groupId: 125, label: "Присадка"},
            {groupId: 128, label: "ЧПУ"},
            {groupId: 127, label: "Криволинейка"},

            {groupId: 196, label: "Подготовка Фасадов"},
            {groupId: 198, label: "Нанесение Изоланта и грунта"},
            {groupId: 199, label: "Шлифовка Фасадов"},
            {groupId: 200, label: "Нанесение покрытия на фасады"},
            {groupId: 197, label: "Упаковка Фасадов"},


            {groupId: 145, label: "Готовая продукция"},
            {groupId: 191, label: "Мастера"},
            {groupId: 192, label: "Приёмо-Передача"},
        ];

        this.filialList = [
            {id: 1, label: "Кишинёв"},
            {id: 3, label: "Бельцы"},
        ];

        this.filialId = null;
        this.groupId = null;
        this.userId = null;
        this.loginList = {};
        this.loginListHolder = document.getElementById("login-list");

        this.passHolder = document.createElement("input");
        this.passHolder.type = "password";
        this.passHolder.autocomplete="new-password";

        // this.loginHolder = ApiClient.createMod();
        // this.loginHolder.headerHolder.innerHTML = "Пароль:";
        // this.loginHolder.bodyHolder.appendChild(this.passHolder);
        // this.loginHolder.save.innerHTML = "Login";
        this.regEvents();
        this.render();
    };

    Loginer.prototype.regEvents = function () {
        this.loginListHolder.addEventListener("click",  (e) => {

            if(e.target.dataset.id.split("-").length > 1){
                this.filialId = e.target.dataset.id.split("-")[1];
                client.load('post', "/api/v1/candidates", {workers: true, filial: this.filialId}).then((data) => {
                    this.loginList = data.content;
                    this.render();
                });
            }else if (e.target.dataset.id !== "#" && this.groupId === null) {
                this.groupId = e.target.dataset.id;
                this.render();

            }else if(e.target.dataset.id === "#" && this.groupId !== null){
                this.groupId = null;
                this.render();
            } else {
                this.userId = e.target.dataset.id;

                if(this.groupId === "145"){
                    this.authenticate();
                }else{
                    this.loginHolder.show();
                }


            }
        });

        // this.loginHolder.save.addEventListener("click", (e) => {
        //     e.preventDefault();
        //     this.authenticate();
        //     this.passHolder.value = "";
        //     this.loginHolder.hide();
        // });
    };
    Loginer.prototype.authenticate = function(){
        const post = {
            login: true,
            filial: this.filialId,
            group: this.groupId,
            id: this.userId,
            password: this.passHolder.value
        };
        client.load("post", "/api/v1/login", post).then((data) => {
            window.localStorage.setItem(ApiClient.jwtStoreIndex, data.jwt);
            window.localStorage.setItem("User", JSON.stringify(data.content));
            window.location.href = data.link;
        });
    }
    Loginer.prototype.render = function () {
        this.loginListHolder.innerHTML = "";

        if(this.filialId === null){
            for (let idx in this.filialList) {
                let item = this.filialList[idx];

                let el = this.getElement( "filial-" + item.id, "#", item.label);
                el.style.width = "382px";
                this.loginListHolder.appendChild(el);
            }

        }else if (this.groupId === null) {
            for (let idx in this.groupList) {
                let item = this.groupList[idx];

                let el = this.getElement(item.groupId,"#",  item.label);
                this.loginListHolder.appendChild(el);
            }


        } else {
            let el = this.getElement("#", "#", "<==== Назад");
            el.style.backgroundColor = "yellow";
            this.loginListHolder.appendChild(el);
            for (let idx in this.loginList) {
                let worker = this.loginList[idx];
                if (worker.region !== +this.groupId) {
                    console.log(worker.region, this.groupId);
                    continue;
                }
                let el = this.getElement(worker.id, "#", worker.displayName);
                this.loginListHolder.appendChild(el);
            }
        }
    };

    Loginer.prototype.getElement = function (id, groupId, value) {
        let vEl = document.createElement("div");
        vEl.innerText = value;
        vEl.style.marginTop = "50px";
        vEl.style.width = "254px";
        vEl.style.height = "100px";
        vEl.dataset.id = id;
        vEl.dataset.groupId = groupId;

        let aEl = document.createElement("div");
        aEl.href = "#";
        aEl.appendChild(vEl);
        aEl.dataset.id = id;
        aEl.dataset.groupId = groupId;

        aEl.style.display = "inline-block";
        aEl.style.cssFloat = "left";
        aEl.style.width = "254px";
        aEl.style.height = "128px";
        aEl.style.border = "1px solid black";
        aEl.style.textAlign = "center";

        aEl.style.fontSize = "1.5em";

        return aEl;

    };


    document.addEventListener("DOMContentLoaded", function (e) {
        new Loginer();
    });
</script>


@endsection
