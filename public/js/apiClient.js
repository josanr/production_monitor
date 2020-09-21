"use strict";

class ApiClient {
    constructor(jwt) {
        this.jwt = window.jwt || jwt || "";
        this.basePath = null;
    }

    setBasePath(path) {
        if (path.slice(path.length - 1) !== "/") {
            path += "/";
        }
        this.basePath = path;
    };

    load(actType, link, postData, noshow){

        let type = "";
        switch (actType.toLowerCase()) {
            case 'post':
                type = 'POST';
                break;
            case 'get':
                type = 'GET';
                break;
            case 'put':
                type = 'PUT';
                break;
            case 'delete':
            case 'del':
                type = 'DELETE';
                break;
        }

        if (!type) {
            throw new Error('Type of action is null');
        }

        if (noshow === undefined) {
            console.log("fade");
        }

        if (this.basePath !== null && link[0] !== "/") {
            link = this.basePath + link;
        }

        let headers = new Headers();
        headers.append("Accept", "application/json");
        headers.append("Content-Type", "application/json");
        headers.append("X-Requested-With", "XMLHttpRequest");
        headers.append("Authorization", "Bearer " + this.jwt);

        const requestInit = {
            headers: headers,
            method: type
        };

        if (type === "GET" && Object.keys(postData).length !== 0) {
            let params = [];
            for (let idx in postData) {
                params.push(idx + "=" + encodeURIComponent(postData[idx]));
            }

            link += "?" + params.join("&");
        }

        if (type !== "GET") {
            requestInit.body = JSON.stringify(postData);
        }

        return window.fetch(link, requestInit)
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    return {ok: response.ok, result: response.text()};
                }
            })
            .then(data => {
                if (data.ok === false) {
                    return data.result.then(text => {
                        return {error: text};
                    });
                } else {
                    return data;
                }
            })
            .then(data => {
                if (data.error) {
                    throw new Error(data.error);
                }
                return data;
            })
            .catch((err) => {
                throw new Error(err.responseText || err.message);
            });
    }
}


ApiClient.jwtStoreIndex = "JWT";
