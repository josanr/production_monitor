/** Created by ruslan on 04/09/2020.*/
"use strict";

class User {
    constructor() {
        this._id = null;
        this._displayName = "";
        this.STORAGE_KEY = "JWT_STORAGE"
        let token = window.localStorage.getItem(this.STORAGE_KEY);
        if (token !== null) {
            let userParams = this.parseJwt(token);
            this._id = userParams._id;
            this._displayName = userParams._displayName;
        }
    }

    parseJwt(token) {
        const base64Payload = token.split('.')[1];
        const payload = Buffer.from(base64Payload, 'base64');
        return JSON.parse(payload.toString());
    }


    get id() {
        return this._id;
    }

    get displayName() {
        return this._displayName;
    }
}
