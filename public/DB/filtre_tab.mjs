const table = 'events';
// const table = 'colors';
// const table = 'event_types';
// const table = 'clients';

import InitTable from './events.mjs';
import fetch from "node-fetch";
import { title } from "process";
// import InitTable from "./clients.mjs";

let final_table = []

InitTable.forEach(e => {
    if (final_table.indexOf(e) == -1)
        final_table.push(e)
});
    
console.log(final_table);

const head = {
    "Accept": "application/ld+json",
    "Content-Type" :"application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2MDI3NTQxNjgsImV4cCI6MTYwMjc1Nzc2OCwicm9sZXMiOlsiUk9MRV9TVVBFUl9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6ImFkbWluIn0.vouyLxOehcmaHQNEqUPPFP6FVmOlmxDvn7pX44UQ41wBGJdcoxEi_r6qRHZJdyMc8VhdSNiiv4jF_05gUOaD4K-TuFZXFtHG9XbYmf2jTBEXlHgmjZxqWt1VcMXzqw4gg3AZgHv1dm07bXoxKX2IXcjeQThG1hS5fzrM98KJTkxzsnFohVzAovycGUMcby3UqA0v_IQSI7my15Zqx6l4BQTewxr-hIUndwo_V93jLszfr5x5_Ms8mGpzagrLldqnFBJfjCfgTIrNyd-bxk353gq5UnetQ28P4BGHwdU_6-TRo4EpPTXYyoq7ZKQEGEmooLpjWJykcLyQ-ZSN7wo13azsH10-CCUWlWRGLVWvADj74dmQ2AOscDi9bfwd20ZiZTAyHHT2CdQdisg-5PDYJ6_sdBuRhOj7WOExbHGFmwN2IJkUuEIKSdAlf9Vk5rM8ixuuHxsSl6QZrbwKO8NwzdGrlBFirgWOCpUOea5VJSoGZ4YxdPff1KsZtvLzq2qPevKWDJBEsx4W-ofvPZOBA3FvO2Rbd5dc2eHQ52wBEDHNOcRITQXLnO_mQl68UskdRz65UrSjsWQoHOy97WJGHNs4_2mVLI-B3h5mw2osEZVTUFqSUk9m7jrIltEGvu3r7_hosy5mry5MPb5FoasaiEHYqmznMr6ZtRYA74ammFQ"
}

final_table.forEach(e => {
    const body = {
        name: e.toLowerCase()
    }
    
    console.log(body);


    fetch(`http://127.0.0.1:8000/api/${table}`, {
        method: 'POST',
        headers: head,
        body: JSON.stringify(body)
    }).then(function(res) {
        return res.json();
    }).then(function(json) {
        console.log('------------')
        console.log(json)
        // console.log(json['hydra:title'])
        // console.log(json['hydra:description'])
        console.log('------------')
    });
});
