var heartbeats = require('heartbeats');
var heart = heartbeats.createHeart(1000);
var age = heart.age;

// Alternative to setInterval 
heart.createEvent(5, function(heartbeat, last){
  console.log('...Every 5 Beats forever');
});
 
heart.createEvent(1, function(heartbeat, last){
  console.log('...Every Single Beat forever');
});
 
heart.createEvent(1, {repeat: 3}, function(heartbeat, last){
  console.log('...Every Single Beat for 3 beats only');
  if(last === true){
    console.log('...the last time.')
  }
});
 
// Alternative to setTimeout 
heart.createEvent(2, {repeat: 1}, function(heartbeat, last){
  console.log('...Once after 2 Beats');
});

var pulseA = heart.createPulse();
var pulseB = heart.createPulse();

pulseA.beat();
pulseB.beat();

console.log( pulseA.missedBeats ); // 0 
console.log( pulseB.missedBeats ); // 0 
 
setInterval(function(){
  pulseB.beat(); // Only synchronizing pulseB with the Heart. 
  console.log( pulseA.missedBeats ); // 2, 4, 6, 8 
  console.log( pulseB.missedBeats ); // 0 
}, 2000);
