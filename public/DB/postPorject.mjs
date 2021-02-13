import Projects from './projects.mjs';
import fetch from "node-fetch";

// const Projects = [];

let projectPost = {};
const nextChar = (c, i) => String.fromCharCode(c.charCodeAt() + i);
const env_perso = 'dev';
const host = env_perso === 'dev' ? 'http://127.0.0.1:8000' : 'https://careva-api.herokuapp.com/';
const head = {
  "Accept": "application/ld+json",
  "Content-Type": "application/json",
  "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2MDM3MzIzMjAsImV4cCI6MTYwMzczNTkyMCwicm9sZXMiOlsiUk9MRV9TVVBFUl9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6ImFkbWluIn0.cJ48AcjSfPdXV9l6GNzhtv-2Knsi2qCPwDi2L7e3nxo5XqBTsms6rz4P33yBNXW8s0y5kHNGZV7TERerSV75v650k_TF6R06eoRv_zl9XW8pOGKNEKJ6VMO9tj-tYnUeq11mrGm1siaM_hAhAtEqrRlwFkWKp7zuvS6cYXTti_UQqcc0GX42lutncZEf8OEizum0XuQmGzMWv6UMcyuKBfsuTh8C3z4EeNu46b2n2aMOixfQPfVMbHNHjN6OjHN4q_pfLNF5AhhqNOv5LWgc2JdZk-F0M6PRzM6k5EBenVS02Zu0FjZQL8gsvsUjEzSfv2G3WtxEv39XxwGaAyb-llyplCBwv5kjawFVnJ5cBX1_x871I_DLcJJgIEBcXCoQ5cHKEPymcajeKv1qmE4LIFM4Pe3ra7cr0Lb8bVaM6HPo-IpBPkNtCnd1JYifLfTTQ0FMtKPxyH_NGRS4HiwJ4lQl6F-HDwK8vKTYySrCaS1bmLp_Ttxf579oLmuifoWAzYXVkAG2Gtxzq2PiycfSYt_4epU6WeMX5plT1QDLUoGRaw6BtwcVs55U7bNI2hbotVRHlO3AH8BVs3TX13S337jVqTfqb37EPwbxNOodkrY35LQbgzSmaVdxlWy_DfOzFq7T_OfgYTftkKVGRgrI3NK1NU-pT52rtUaT1ztAnNk"
}


Projects.forEach(project => {
  projectPost.client = project.client;
  projectPost.color = project.couleur;
  projectPost.event = project.evenement;
  projectPost.year = project.annee;
  projectPost.project_type = project.categorie;
  projectPost.event_type = project.salontype;
  projectPost.site = project.site;

  projectPost.medias = {}
  projectPost.medias.thumb = project.filename;
  if (project.filevideo) projectPost.medias.video = [project.filevideo];
  if (project.scketchfab) projectPost.medias.scketchfab = project.scketchfab;
  if (!project.filevideo && !project.scketchfab) {
    let [client, nb_img, img_actuel, ext] = project.filename.split('.');
    let img_new = img_actuel;
    projectPost.medias.large = [];

    for (let num_img = 1; num_img <= nb_img; num_img++) {
      if (num_img > 1) img_new = nextChar(img_actuel, num_img - 1);

      const filename_final = [client, nb_img, img_new, ext].join('.');
      projectPost.medias.large.push(filename_final);
    }
  }

  // console.log(projectPost)

  fetch(`${host}/custom/projects`, {
    method: 'POST',
    headers: head,
    body: JSON.stringify(projectPost)
  })
    // .then(res => console.log(res)) //res.json())
    .then(res => res.json())
    .then(json => {
      console.log('------------')
      if (json['hydra:title'] && json['hydra:description'] && /30 seconds exceeded/i.test(json['hydra:description']))
        console.log('TIMEOUT')
      else if (json.status) {
        console.log(json)
      }
      console.log(json)
      // console.log(json['hydra:title'])
      // console.log(json['hydra:description'])
      console.log('------------')
    })
    .catch(err => console.error(err));
});
