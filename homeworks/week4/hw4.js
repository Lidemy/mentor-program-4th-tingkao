const request = require('request');

const options = {
  url: 'https://api.twitch.tv/kraken/games/top',
  headers: {
    Accept: 'application/vnd.twitchtv.v5+json',
    'Client-ID': 'uwpvt9ahl8ysuv4r7ditx45msdv1sb',
  },
};

function callback(error, response, body) {
  const info = JSON.parse(body);
  for (let i = 0; i < info.top.length; i += 1) {
    console.log(`${info.top[i].viewers} ${info.top[i].game.name}`);
  }
}
request(options, callback);
