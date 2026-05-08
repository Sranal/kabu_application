(function (cjs, an) {

var p; // shortcut to reference prototypes
var lib={};var ss={};var img={};
lib.ssMetadata = [];


(lib.AnMovieClip = function(){
	this.currentSoundStreamInMovieclip;
	this.actionFrames = [];
	this.soundStreamDuration = new Map();
	this.streamSoundSymbolsList = [];

	this.gotoAndPlayForStreamSoundSync = function(positionOrLabel){
		cjs.MovieClip.prototype.gotoAndPlay.call(this,positionOrLabel);
	}
	this.gotoAndPlay = function(positionOrLabel){
		this.clearAllSoundStreams();
		this.startStreamSoundsForTargetedFrame(positionOrLabel);
		cjs.MovieClip.prototype.gotoAndPlay.call(this,positionOrLabel);
	}
	this.play = function(){
		this.clearAllSoundStreams();
		this.startStreamSoundsForTargetedFrame(this.currentFrame);
		cjs.MovieClip.prototype.play.call(this);
	}
	this.gotoAndStop = function(positionOrLabel){
		cjs.MovieClip.prototype.gotoAndStop.call(this,positionOrLabel);
		this.clearAllSoundStreams();
	}
	this.stop = function(){
		cjs.MovieClip.prototype.stop.call(this);
		this.clearAllSoundStreams();
	}
	this.startStreamSoundsForTargetedFrame = function(targetFrame){
		for(var index=0; index<this.streamSoundSymbolsList.length; index++){
			if(index <= targetFrame && this.streamSoundSymbolsList[index] != undefined){
				for(var i=0; i<this.streamSoundSymbolsList[index].length; i++){
					var sound = this.streamSoundSymbolsList[index][i];
					if(sound.endFrame > targetFrame){
						var targetPosition = Math.abs((((targetFrame - sound.startFrame)/lib.properties.fps) * 1000));
						var instance = playSound(sound.id);
						var remainingLoop = 0;
						if(sound.offset){
							targetPosition = targetPosition + sound.offset;
						}
						else if(sound.loop > 1){
							var loop = targetPosition /instance.duration;
							remainingLoop = Math.floor(sound.loop - loop);
							if(targetPosition == 0){ remainingLoop -= 1; }
							targetPosition = targetPosition % instance.duration;
						}
						instance.loop = remainingLoop;
						instance.position = Math.round(targetPosition);
						this.InsertIntoSoundStreamData(instance, sound.startFrame, sound.endFrame, sound.loop , sound.offset);
					}
				}
			}
		}
	}
	this.InsertIntoSoundStreamData = function(soundInstance, startIndex, endIndex, loopValue, offsetValue){ 
 		this.soundStreamDuration.set({instance:soundInstance}, {start: startIndex, end:endIndex, loop:loopValue, offset:offsetValue});
	}
	this.clearAllSoundStreams = function(){
		var keys = this.soundStreamDuration.keys();
		for(var i = 0;i<this.soundStreamDuration.size; i++){
			var key = keys.next().value;
			key.instance.stop();
		}
 		this.soundStreamDuration.clear();
		this.currentSoundStreamInMovieclip = undefined;
	}
	this.stopSoundStreams = function(currentFrame){
		if(this.soundStreamDuration.size > 0){
			var keys = this.soundStreamDuration.keys();
			for(var i = 0; i< this.soundStreamDuration.size ; i++){
				var key = keys.next().value; 
				var value = this.soundStreamDuration.get(key);
				if((value.end) == currentFrame){
					key.instance.stop();
					if(this.currentSoundStreamInMovieclip == key) { this.currentSoundStreamInMovieclip = undefined; }
					this.soundStreamDuration.delete(key);
				}
			}
		}
	}

	this.computeCurrentSoundStreamInstance = function(currentFrame){
		if(this.currentSoundStreamInMovieclip == undefined){
			if(this.soundStreamDuration.size > 0){
				var keys = this.soundStreamDuration.keys();
				var maxDuration = 0;
				for(var i=0;i<this.soundStreamDuration.size;i++){
					var key = keys.next().value;
					var value = this.soundStreamDuration.get(key);
					if(value.end > maxDuration){
						maxDuration = value.end;
						this.currentSoundStreamInMovieclip = key;
					}
				}
			}
		}
	}
	this.getDesiredFrame = function(currentFrame, calculatedDesiredFrame){
		for(var frameIndex in this.actionFrames){
			if((frameIndex > currentFrame) && (frameIndex < calculatedDesiredFrame)){
				return frameIndex;
			}
		}
		return calculatedDesiredFrame;
	}

	this.syncStreamSounds = function(){
		this.stopSoundStreams(this.currentFrame);
		this.computeCurrentSoundStreamInstance(this.currentFrame);
		if(this.currentSoundStreamInMovieclip != undefined){
			var soundInstance = this.currentSoundStreamInMovieclip.instance;
			if(soundInstance.position != 0){
				var soundValue = this.soundStreamDuration.get(this.currentSoundStreamInMovieclip);
				var soundPosition = (soundValue.offset?(soundInstance.position - soundValue.offset): soundInstance.position);
				var calculatedDesiredFrame = (soundValue.start)+((soundPosition/1000) * lib.properties.fps);
				if(soundValue.loop > 1){
					calculatedDesiredFrame +=(((((soundValue.loop - soundInstance.loop -1)*soundInstance.duration)) / 1000) * lib.properties.fps);
				}
				calculatedDesiredFrame = Math.floor(calculatedDesiredFrame);
				var deltaFrame = calculatedDesiredFrame - this.currentFrame;
				if(deltaFrame >= 2){
					this.gotoAndPlayForStreamSoundSync(this.getDesiredFrame(this.currentFrame,calculatedDesiredFrame));
				}
			}
		}
	}
}).prototype = p = new cjs.MovieClip();
// symbols:



(lib.Image = function() {
	this.initialize(img.Image);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,498,464);


(lib.Image_0 = function() {
	this.initialize(img.Image_0);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,713,410);


(lib.flash0aiアセット = function() {
	this.initialize(img.flash0aiアセット);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,137,58);


(lib.flash0aiアセット_1 = function() {
	this.initialize(img.flash0aiアセット_1);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,69,80);


(lib.flash0aiアセット_2 = function() {
	this.initialize(img.flash0aiアセット_2);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,225,128);


(lib.flash0aiアセット_3 = function() {
	this.initialize(img.flash0aiアセット_3);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,137,145);


(lib.flash0aiアセット_4 = function() {
	this.initialize(img.flash0aiアセット_4);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,278,575);


(lib.flash0aiアセット_5 = function() {
	this.initialize(img.flash0aiアセット_5);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,550,121);


(lib.flash0aiアセット_6 = function() {
	this.initialize(img.flash0aiアセット_6);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,230,241);


(lib.flash0aiアセット_7 = function() {
	this.initialize(img.flash0aiアセット_7);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,708,159);


(lib.flash0aiアセット_8 = function() {
	this.initialize(img.flash0aiアセット_8);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,226,128);// helper functions:

function mc_symbol_clone() {
	var clone = this._cloneProps(new this.constructor(this.mode, this.startPosition, this.loop));
	clone.gotoAndStop(this.currentFrame);
	clone.paused = this.paused;
	clone.framerate = this.framerate;
	return clone;
}

function getMCSymbolPrototype(symbol, nominalBounds, frameBounds) {
	var prototype = cjs.extend(symbol, cjs.MovieClip);
	prototype.clone = mc_symbol_clone;
	prototype.nominalBounds = nominalBounds;
	prototype.frameBounds = frameBounds;
	return prototype;
	}


(lib.シンボル54 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// レイヤー_1
	this.instance = new lib.Image_0();
	this.instance.setTransform(-10.25,-16.65,0.0838,0.0838);

	this.instance_1 = new lib.Image();
	this.instance_1.setTransform(-55,-21.6,0.086,0.086);

	this.shape = new cjs.Shape();
	this.shape.graphics.f("#FFFFFF").s().p("ArrE3QgNAAgJgKQgKgKAAgNIAApMIYXAAIAAJMQAAANgKAKQgJAKgNAAg");
	this.shape.setTransform(0,0.025);

	this.timeline.addTween(cjs.Tween.get({}).to({state:[{t:this.shape},{t:this.instance_1},{t:this.instance}]}).wait(1));

	this._renderFirstFrame();

}).prototype = getMCSymbolPrototype(lib.シンボル54, new cjs.Rectangle(-78,-31,156,62.1), null);


(lib.シンボル52 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// レイヤー_2
	this.instance = new lib.flash0aiアセット_5();
	this.instance.setTransform(-275,-61);

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

	this._renderFirstFrame();

}).prototype = getMCSymbolPrototype(lib.シンボル52, new cjs.Rectangle(-275,-61,550,121), null);


(lib.シンボル51 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// レイヤー_2
	this.instance = new lib.flash0aiアセット_7();
	this.instance.setTransform(-365,-52);

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

	this._renderFirstFrame();

}).prototype = getMCSymbolPrototype(lib.シンボル51, new cjs.Rectangle(-365,-52,708,159), null);


(lib.シンボル50 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// レイヤー_2
	this.instance = new lib.flash0aiアセット_8();
	this.instance.setTransform(-115,-45);

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

	this._renderFirstFrame();

}).prototype = getMCSymbolPrototype(lib.シンボル50, new cjs.Rectangle(-115,-45,226,128), null);


(lib.シンボル49 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// レイヤー_2
	this.instance = new lib.flash0aiアセット_2();
	this.instance.setTransform(-114,-35);

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

	this._renderFirstFrame();

}).prototype = getMCSymbolPrototype(lib.シンボル49, new cjs.Rectangle(-114,-35,225,128), null);


(lib.シンボル46 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// レイヤー_2
	this.instance = new lib.flash0aiアセット_1();
	this.instance.setTransform(-24,-28,0.7072,0.7072);

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

	this._renderFirstFrame();

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-24,-28,48.8,56.6);


(lib.シンボル44 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// レイヤー_2
	this.instance = new lib.flash0aiアセット_6();
	this.instance.setTransform(-115,-122);

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

	this._renderFirstFrame();

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-115,-122,230,241);


(lib.money = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// レイヤー_2
	this.instance = new lib.flash0aiアセット();
	this.instance.setTransform(-69,-29);

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

	this._renderFirstFrame();

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-69,-29,137,58);


(lib.ATM = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// レイヤー_8
	this.shape = new cjs.Shape();
	this.shape.graphics.f("#28AC3D").s().p("Ah6EJIAAqJID1B4IAAKJg");
	this.shape.setTransform(-19.3,17.425);

	this.shape_1 = new cjs.Shape();
	this.shape_1.graphics.f("#4AE770").s().p("Ah6EJIAAqJID1B4IAAKJg");
	this.shape_1.setTransform(-19.3,17.425);

	this.timeline.addTween(cjs.Tween.get({}).to({state:[{t:this.shape}]}).to({state:[{t:this.shape_1}]},9).to({state:[{t:this.shape}]},10).to({state:[{t:this.shape_1}]},9).to({state:[{t:this.shape}]},11).to({state:[{t:this.shape_1}]},9).to({state:[{t:this.shape}]},11).wait(31));

	// レイヤー_9
	this.shape_2 = new cjs.Shape();
	this.shape_2.graphics.f("#28AC3D").s().p("AloCUIAAqJILRFiIAAKJg");
	this.shape_2.setTransform(-79.625,-12.125);

	this.shape_3 = new cjs.Shape();
	this.shape_3.graphics.f("#4AE770").s().p("AloCUIAAqJILRFiIAAKJg");
	this.shape_3.setTransform(-79.625,-12.125);

	this.timeline.addTween(cjs.Tween.get({}).to({state:[{t:this.shape_2}]}).to({state:[{t:this.shape_3}]},9).to({state:[{t:this.shape_2}]},10).to({state:[{t:this.shape_3}]},9).to({state:[{t:this.shape_2}]},11).to({state:[{t:this.shape_3}]},9).to({state:[{t:this.shape_2}]},11).wait(31));

	// レイヤー_2
	this.instance = new lib.flash0aiアセット_4();
	this.instance.setTransform(-139,-288);

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(90));

	this._renderFirstFrame();

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-139,-288,278,575);


(lib.シンボル53 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// timeline functions:
	this.frame_29 = function() {
		this.stop();
	}

	// actions tween:
	this.timeline.addTween(cjs.Tween.get(this).wait(29).call(this.frame_29).wait(1));

	// レイヤー_1
	this.instance = new lib.シンボル54();
	this.instance.setTransform(0,-63);

	this.timeline.addTween(cjs.Tween.get(this.instance).to({y:0},29,cjs.Ease.quadOut).wait(1));

	this._renderFirstFrame();

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-78,-94,156,125.1);


(lib.シンボル48 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// timeline functions:
	this.frame_219 = function() {
		this.stop();
	}

	// actions tween:
	this.timeline.addTween(cjs.Tween.get(this).wait(219).call(this.frame_219).wait(1));

	// レイヤー_1
	this.instance = new lib.シンボル44("synched",0);
	this.instance.setTransform(57.05,59.2);
	this.instance.alpha = 0;
	this.instance._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(189).to({_off:false},0).to({x:0,y:2.15,alpha:1},30,cjs.Ease.quadOut).wait(1));

	this._renderFirstFrame();

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-115,-119.8,287.1,298);


(lib.シンボル47 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// レイヤー_1
	this.instance = new lib.シンボル46("synched",0);

	this.timeline.addTween(cjs.Tween.get(this.instance).to({scaleX:1.4191,scaleY:1.4191},29,cjs.Ease.quadIn).to({scaleX:1,scaleY:1},30,cjs.Ease.quadOut).wait(1));

	this._renderFirstFrame();

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-34,-39.7,69.2,80.30000000000001);


(lib.シンボル45 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// timeline functions:
	this.frame_59 = function() {
		this.stop();
	}

	// actions tween:
	this.timeline.addTween(cjs.Tween.get(this).wait(59).call(this.frame_59).wait(1));

	// シンボル_47
	this.instance = new lib.シンボル47();
	this.instance.setTransform(551.3,-178.55,0.6335,0.6335,0,0,0,0.1,-0.1);
	this.instance._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(39).to({_off:false},0).wait(21));

	// シンボル_47
	this.instance_1 = new lib.シンボル47();
	this.instance_1.setTransform(533.65,40.4,0.6248,0.6248,0,0,0,0.1,0.1);
	this.instance_1._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_1).wait(19).to({_off:false},0).wait(41));

	// シンボル_47
	this.instance_2 = new lib.シンボル47();
	this.instance_2.setTransform(228.15,326.25,0.6476,0.6476,0,0,0,0,0.1);
	this.instance_2._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_2).wait(54).to({_off:false},0).wait(6));

	// シンボル_47
	this.instance_3 = new lib.シンボル47();
	this.instance_3.setTransform(31.2,81.65,0.4838,0.4838);
	this.instance_3._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_3).wait(34).to({_off:false},0).wait(26));

	// シンボル_47
	this.instance_4 = new lib.シンボル47();
	this.instance_4.setTransform(-267.7,250.35,0.375,0.375);
	this.instance_4._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_4).wait(14).to({_off:false},0).wait(46));

	// シンボル_47
	this.instance_5 = new lib.シンボル47();
	this.instance_5.setTransform(-443.15,310.25,0.4652,0.4652,0,0,0,-0.2,0.5);
	this.instance_5._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_5).wait(49).to({_off:false},0).wait(11));

	// シンボル_47
	this.instance_6 = new lib.シンボル47();
	this.instance_6.setTransform(-550.95,253.35,0.6514,0.6514,0,0,0,0,0.1);
	this.instance_6._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_6).wait(29).to({_off:false},0).wait(31));

	// シンボル_47
	this.instance_7 = new lib.シンボル47();
	this.instance_7.setTransform(-476.3,-273.7,0.7162,0.7162);
	this.instance_7._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_7).wait(9).to({_off:false},0).wait(51));

	// シンボル_47
	this.instance_8 = new lib.シンボル47();
	this.instance_8.setTransform(-350.75,-330.7,0.5524,0.5524,0,0,0,-0.1,0);
	this.instance_8._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_8).wait(44).to({_off:false},0).wait(16));

	// シンボル_47
	this.instance_9 = new lib.シンボル47();
	this.instance_9.setTransform(-2.45,-325.65,0.5285,0.5285,0,0,0,-0.1,0);
	this.instance_9._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_9).wait(24).to({_off:false},0).wait(36));

	// シンボル_47
	this.instance_10 = new lib.シンボル47();
	this.instance_10.setTransform(-155.1,-284.6,0.4605,0.4605);
	this.instance_10._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_10).wait(4).to({_off:false},0).wait(56));

	// シンボル_47
	this.instance_11 = new lib.シンボル47();
	this.instance_11.setTransform(140.05,-257.1);

	this.timeline.addTween(cjs.Tween.get(this.instance_11).wait(60));

	this._renderFirstFrame();

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-566.6,-346.1,1133.6,690.8);


(lib.シンボル43 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// timeline functions:
	this.frame_179 = function() {
		this.stop();
	}

	// actions tween:
	this.timeline.addTween(cjs.Tween.get(this).wait(179).call(this.frame_179).wait(1));

	// レイヤー_1
	this.instance = new lib.シンボル52();
	this.instance.setTransform(119,0);
	this.instance.alpha = 0;
	this.instance._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(149).to({_off:false},0).to({x:0,alpha:1},30,cjs.Ease.quadOut).wait(1));

	this._renderFirstFrame();

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-275,-61,669,121);


(lib.シンボル42 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// timeline functions:
	this.frame_144 = function() {
		this.stop();
	}

	// actions tween:
	this.timeline.addTween(cjs.Tween.get(this).wait(144).call(this.frame_144).wait(1));

	// 引き出し可能_
	this.instance = new lib.シンボル51();
	this.instance.setTransform(0,134.5);
	this.instance.alpha = 0;
	this.instance._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(114).to({_off:false},0).to({y:80.5,alpha:1},30,cjs.Ease.quadOut).wait(1));

	// _0
	this.shape = new cjs.Shape();
	this.shape.graphics.f("#FFFFFF").s().p("AgLJjIAAsZIkJAAIAAjLQBOgBA/gQQBAgQAugxQAtgvAdhgIDkAAIAATFg");
	this.shape.setTransform(35.075,-39.825);

	this.shape_1 = new cjs.Shape();
	this.shape_1.graphics.f("#FFFFFF").s().p("AoIJ0QAIhlAhhNQAihNA8hCQA9hDBbhEQBbhEB7hSQBcg/AzgqQA0gpAWgcQAXgdAFgWQAEgWgBgXQgBg7ghgfQgigggvgMQgvgNgqABQhmABgyApQgyAogQA6QgQA5gCA0IkfAAQACgxAGgzQAGg0AUg0QAUg0Aqg1QBPhdBtgoQBugpCDABQCEABBdAgQBcAhA5A2QA6A2AZBCQAaBCAABDQgBBMgWA2QgWA1gXAeQgZAiguAoQgvApg3ApQg3Aqg0AkIhXA7IgpAbQgwAggbATQgbAUgRAPQgSAPgTASIKDAAIAADmg");
	this.shape_1.setTransform(41.925,-41.5262);

	this.shape_2 = new cjs.Shape();
	this.shape_2.graphics.f("#FFFFFF").s().p("Aj8JZQhvgthGhhQhGhigNieIEjAAQABAXAHAiQAFAjAWAjQAVAjAsAXQAtAYBOAAQAKABAkgEQAlgEApgQQApgQAfgjQAeglABg+QABhMg2gxQg2gxhygBIhbAAIAAi9IBOAAQALABAhgFQAigFAmgQQAogQAbgeQAcgfACgyQgBgvgWgbQgVgbgggMQgfgLgdgCQgegDgTABQg7gBgtAKQguALgbAhQgaAigCBCIkiAAQATiQBFhXQBEhWBtgmQBrgmCHABQCQABBmApQBmApA1BLQA1BKABBkQgDBdghA1QghA1gsAbQgtAaggALQAcAKAlASQAlASAjAfQAlAhAXAzQAXA0ABBOQgBBngpBNQgrBLhJAxQhIAyheAZQhfAYhoAAIgFAAQiEAAhtgsg");
	this.shape_2.setTransform(41.55,-39.8252);

	this.shape_3 = new cjs.Shape();
	this.shape_3.graphics.f("#FFFFFF").s().p("AA3JjIAAj9IpDAAIAAjrIJGrdIEWAAIAALeIC9AAIAADqIi9AAIAAD9gAkdB8IFUAAIAAmsg");
	this.shape_3.setTransform(41.6,-39.825);

	this.shape_4 = new cjs.Shape();
	this.shape_4.graphics.f("#FFFFFF").s().p("AkMJHQhjgrgyg/Qgzg/gUg+QgTg9gFgmIElAAQAMA0AeAfQAfAdAlAMQAkANAeADQAeADANgBQBpgBA9g3QA9g3ABhbQgBhEgdgvQgfgugwgXQgxgYg6AAQgzAAgiAKQgiAJgWAPQgVAOgSAPIkxAAIB9qjIMIAAIAADkIoTAAIgvD3QA/grBDgMQBCgNA0ABQBLAABJAYQBJAXA9AxQA8AxAkBKQAkBMABBoQgBCEg7BkQg9Blh0A5QhzA5imABQikgChjgrg");
	this.shape_4.setTransform(41.925,-38.125);

	this.shape_5 = new cjs.Shape();
	this.shape_5.graphics.f("#FFFFFF").s().p("AicJqQhGgYgmgZQhthEg2hhQg2hhgShqQgShqABhfQACi0Ath3QArh3BFhHQBFhFBMgiQBLghA/gKQBAgKAhABQA2gBBIAQQBJAOBKAmQBKAlA4BCQA4BDAVBmIknAAQgGgQgSgZQgRgYgmgTQgngThFAAQhYAAg0AiQg0AhgaAzQgaA0gIA4QgJA3gDAuQAagZAmgbQAmgaA/gSQA/gSBigBQCDABBhAvQBhAvA2BYQA2BXABB7QAABWgdBQQgfBQg8A/Qg9BAheAlQhdAlh+ABQhsgChHgZgAhoAmQg0AWggArQggArgBBAQAAAzAZAuQAZAuAzAdQA0AeBNAAQBNAAAzgeQAzgdAZguQAZguAAgzQgBhBgggrQghgrgzgWQg1gVg7AAQg9AAg0AWg");
	this.shape_5.setTransform(41.5444,-39.8295);

	this.shape_6 = new cjs.Shape();
	this.shape_6.graphics.f("#FFFFFF").s().p("AjoJjQAAgtAIhRQAIhSAchwQAdhwA9iLQAzhrAxhLQAyhLA1g4QAzg5A3g0IrIAAIAAjkIPqAAIAADjQghAVg1AvQg3Avg9BUQg+BWg/CKQgyBygYBkQgYBkgJBZQgJBYgDBQg");
	this.shape_6.setTransform(41.6,-39.825);

	this.shape_7 = new cjs.Shape();
	this.shape_7.graphics.f("#FFFFFF").s().p("AABKFQgxABhAgHQhCgHhFgUQhFgVg7gpQg6gogphJQgphJgBhhQABhTAcg4QAbg4AogiQAnghAmgRQAngRAVgHQhfgsgpg6Qgpg5gJgwQgIgxABgRQAChSAlhAQAlg/A7gqQAughA/gSQA+gSBAgIQBAgHAxAAQCiACBfApQBfAoAuA5QAuA6AOA2QANA2gBAdQABAxgTAzQgRAzgqAtQgrAuhIAfQAVAHAlARQAnARAnAhQAoAiAbA4QAcA4ABBTQgBBXgkBLQglBLhCAuQg9ArhIAUQhGAUhCAHQg4AFgnAAIgMAAgABqGKQA0gQAjgoQAigmAChBQABgUgJgeQgHgcgYgeQgWgdgvgUQgugUhKAAQhjABgyAhQgxAhgQApQgQApACAcQABBBAjAmQAiAoA1AQQA0ASA1gBQA1ABA0gSgAhzmBQgqAZgPAiQgQAiAAAeQAAAIAEAXQAEAXARAbQARAbAnATQAnATBEABQBEgBAngSQAmgTASgbQASgaAEgXQAEgXgBgJQACgdgRgiQgPgjgpgaQgqgZhKgBQhKABgqAZg");
	this.shape_7.setTransform(41.55,-39.8179);

	this.shape_8 = new cjs.Shape();
	this.shape_8.graphics.f("#FFFFFF").s().p("AgWKFQg2ABhIgQQhJgOhKgmQhKglg4hCQg4hDgVhmIEoAAQAGAQASAZQARAYAmATQAmATBFAAQBYAAA0giQA0ghAagzQAag0AIg4QAJg3ADguQgaAZgmAbQgmAag/ASQg/AShiABQiCgBhhgvQhigvg2hYQg2hXgBh7QAAhWAdhQQAfhQA8g/QA+hABdglQBdglB+gBQBsACBHAZQBHAYAlAZQBtBEA2BhQA2BhASBqQASBqgBBeQgCC1gsB3QgsB3hFBHQhFBFhMAiQhLAhg/AKQg6AJggAAIgHAAgAiHl9Qg0AdgZAuQgZAuAAAzQABBBAgArQAhArA0AWQA0AVA9AAQA8AAA1gWQAzgWAggrQAggrAAhAQAAgzgZguQgZgugygdQg0gehMAAQhOAAgzAeg");
	this.shape_8.setTransform(41.5558,-39.8205);

	this.shape_9 = new cjs.Shape();
	this.shape_9.graphics.f("#FFFFFF").s().p("Ai9JlQhRgeg1guQg1gtgfgvQgog9gYhSQgZhTgJhVQgLhVAAhEQgBgvAJhLQAIhMAchWQAchXA4hNQA4hNBfgxQBfgxCPgCQCIACBcArQBcAsA4BIQA6BJAfBYQAeBYAKBZQALBZAABMQAAAvgHBLQgJBMgbBWQgcBXg4BNQg4BNhfAxQhfAxiPACQhvgChPgegAhul1QgsAkgZA4QgYA3gKA6QgKA6gDAvQgCAuABARQgBARACAtQADAuAKA6QAKA8AYA3QAZA4AsAkQAsAkBDACQBEgCArgkQArgkAYg3QAZg4AKg7QALg6ACguQADgugBgRQABgRgDgvQgCgugLg7QgKg6gZg3QgYg3grgkQgrgjhEgCQhDACgsAjg");
	this.shape_9.setTransform(41.55,-39.825);

	this.shape_10 = new cjs.Shape();
	this.shape_10.graphics.f("#FFFFFF").s().p("AgLJjIAAsZIkJAAIAAjLQBOgBA/gQQBAgQAugxQAtgvAdhgIDkAAIAATFg");
	this.shape_10.setTransform(-80.225,-39.825);

	this.shape_11 = new cjs.Shape();
	this.shape_11.graphics.f("#FFFFFF").s().p("AoIJ0QAIhlAhhNQAihNA8hCQA9hDBbhEQBbhEB7hSQBcg/AzgqQA0gpAWgcQAXgdAFgWQAEgWgBgXQgBg7ghgfQgigggvgMQgvgNgqABQhmABgyApQgyAogQA6QgQA5gCA0IkfAAQACgxAGgzQAGg0AUg0QAUg0Aqg1QBPhdBtgoQBugpCDABQCEABBdAgQBcAhA5A2QA6A2AZBCQAaBCAABDQgBBMgWA2QgWA1gXAeQgZAiguAoQgvApg3ApQg3Aqg0AkIhXA7IgpAbQgwAggbATQgbAUgRAPQgSAPgTASIKDAAIAADmg");
	this.shape_11.setTransform(-73.375,-41.5262);

	this.shape_12 = new cjs.Shape();
	this.shape_12.graphics.f("#FFFFFF").s().p("Aj8JZQhvgthGhhQhGhigNieIEjAAQABAXAHAiQAFAjAWAjQAVAjAsAXQAtAYBOAAQAKABAkgEQAlgEApgQQAqgQAegjQAeglABg+QAChMg3gxQg3gxhxgBIhbAAIAAi9IBOAAQAMABAggFQAigFAmgQQAogQAbgeQAcgfACgyQgBgvgWgbQgVgbgggMQgegLgegCQgegDgTABQg7gBgtAKQguALgbAhQgaAigCBCIkiAAQASiQBGhXQBEhWBsgmQBsgmCGABQCSABBlApQBmApA1BLQA1BKABBkQgDBdghA1QghA1gtAbQgsAaggALQAcAKAlASQAlASAjAfQAlAhAXAzQAXA0ABBOQgBBngpBNQgrBLhJAxQhIAyheAZQhfAYhoAAIgFAAQiEAAhtgsg");
	this.shape_12.setTransform(-73.75,-39.8252);

	this.shape_13 = new cjs.Shape();
	this.shape_13.graphics.f("#FFFFFF").s().p("AA3JjIAAj9IpDAAIAAjrIJGrdIEWAAIAALeIC9AAIAADqIi9AAIAAD9gAkdB8IFUAAIAAmsg");
	this.shape_13.setTransform(-73.7,-39.825);

	this.timeline.addTween(cjs.Tween.get({}).to({state:[]}).to({state:[{t:this.shape,p:{x:35.075}}]},29).to({state:[{t:this.shape_1,p:{x:41.925}}]},1).to({state:[{t:this.shape_2}]},1).to({state:[{t:this.shape_3,p:{x:41.6}}]},1).to({state:[{t:this.shape_4,p:{x:41.925}}]},1).to({state:[{t:this.shape_5}]},1).to({state:[{t:this.shape_6}]},1).to({state:[{t:this.shape_7}]},1).to({state:[{t:this.shape_8}]},1).to({state:[{t:this.shape,p:{x:-80.225}},{t:this.shape_9}]},1).to({state:[{t:this.shape_10},{t:this.shape,p:{x:35.075}}]},1).to({state:[{t:this.shape,p:{x:-80.225}},{t:this.shape_1,p:{x:41.925}}]},1).to({state:[{t:this.shape,p:{x:-80.225}},{t:this.shape_2}]},1).to({state:[{t:this.shape,p:{x:-80.225}},{t:this.shape_3,p:{x:41.6}}]},1).to({state:[{t:this.shape,p:{x:-80.225}},{t:this.shape_4,p:{x:41.925}}]},1).to({state:[{t:this.shape,p:{x:-80.225}},{t:this.shape_5}]},1).to({state:[{t:this.shape,p:{x:-80.225}},{t:this.shape_6}]},1).to({state:[{t:this.shape,p:{x:-80.225}},{t:this.shape_7}]},1).to({state:[{t:this.shape,p:{x:-80.225}},{t:this.shape_8}]},1).to({state:[{t:this.shape_1,p:{x:-73.375}},{t:this.shape_9}]},1).to({state:[{t:this.shape_1,p:{x:-73.375}},{t:this.shape,p:{x:35.075}}]},1).to({state:[{t:this.shape_11},{t:this.shape_1,p:{x:41.925}}]},1).to({state:[{t:this.shape_1,p:{x:-73.375}},{t:this.shape_2}]},1).to({state:[{t:this.shape_1,p:{x:-73.375}},{t:this.shape_3,p:{x:41.6}}]},1).to({state:[{t:this.shape_1,p:{x:-73.375}},{t:this.shape_4,p:{x:41.925}}]},1).to({state:[{t:this.shape_1,p:{x:-73.375}},{t:this.shape_5}]},1).to({state:[{t:this.shape_1,p:{x:-73.375}},{t:this.shape_6}]},1).to({state:[{t:this.shape_1,p:{x:-73.375}},{t:this.shape_7}]},1).to({state:[{t:this.shape_1,p:{x:-73.375}},{t:this.shape_8}]},1).to({state:[{t:this.shape_12},{t:this.shape_9}]},1).to({state:[{t:this.shape_12},{t:this.shape,p:{x:35.075}}]},1).to({state:[{t:this.shape_12},{t:this.shape_1,p:{x:41.925}}]},1).to({state:[{t:this.shape_12},{t:this.shape_2}]},1).to({state:[{t:this.shape_12},{t:this.shape_3,p:{x:41.6}}]},1).to({state:[{t:this.shape_12},{t:this.shape_4,p:{x:41.925}}]},1).to({state:[{t:this.shape_12},{t:this.shape_5}]},1).to({state:[{t:this.shape_12},{t:this.shape_6}]},1).to({state:[{t:this.shape_12},{t:this.shape_7}]},1).to({state:[{t:this.shape_12},{t:this.shape_8}]},1).to({state:[{t:this.shape_3,p:{x:-73.7}},{t:this.shape_9}]},1).to({state:[{t:this.shape_3,p:{x:-73.7}},{t:this.shape,p:{x:35.075}}]},1).to({state:[{t:this.shape_3,p:{x:-73.7}},{t:this.shape_1,p:{x:41.925}}]},1).to({state:[{t:this.shape_3,p:{x:-73.7}},{t:this.shape_2}]},1).to({state:[{t:this.shape_13},{t:this.shape_3,p:{x:41.6}}]},1).to({state:[{t:this.shape_3,p:{x:-73.7}},{t:this.shape_4,p:{x:41.925}}]},1).to({state:[{t:this.shape_3,p:{x:-73.7}},{t:this.shape_5}]},1).to({state:[{t:this.shape_3,p:{x:-73.7}},{t:this.shape_6}]},1).to({state:[{t:this.shape_3,p:{x:-73.7}},{t:this.shape_7}]},1).to({state:[{t:this.shape_3,p:{x:-73.7}},{t:this.shape_8}]},1).to({state:[{t:this.shape_4,p:{x:-73.375}},{t:this.shape_9}]},1).wait(67));

	// 万円
	this.instance_1 = new lib.シンボル50();
	this.instance_1.setTransform(316.45,-44);
	this.instance_1.alpha = 0;
	this.instance_1._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_1).wait(79).to({_off:false},0).to({x:227.45,alpha:1},30,cjs.Ease.quadIn).wait(36));

	// 毎月
	this.instance_2 = new lib.シンボル49();
	this.instance_2.setTransform(-251.1,-165.5);
	this.instance_2.alpha = 0;

	this.timeline.addTween(cjs.Tween.get(this.instance_2).to({y:-58.45,alpha:1},29,cjs.Ease.quadOut).wait(116));

	this._renderFirstFrame();

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-365.1,-200.5,792.6,442);


(lib.シンボル41 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// レイヤー_1
	this.instance = new lib.ATM();
	this.instance.setTransform(2,0,1,1,0,0,0,2,0);

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

	this._renderFirstFrame();

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-139,-288,278,575);


(lib.moneyanimation = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// timeline functions:
	this.frame_0 = function() {
		this.play();
	}
	this.frame_89 = function() {
		this.stop();
	}

	// actions tween:
	this.timeline.addTween(cjs.Tween.get(this).call(this.frame_0).wait(89).call(this.frame_89).wait(1));

	// レイヤー_14
	this.instance = new lib.flash0aiアセット_3();
	this.instance.setTransform(-227,112);
	this.instance._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(89).to({_off:false},0).wait(1));

	// レイヤー_10
	this.instance_1 = new lib.money("synched",0);
	this.instance_1._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_1).wait(44).to({_off:false},0).to({guide:{path:[0,0.1,-122.9,12.2,-155.7,141.6]}},30,cjs.Ease.quadOut).to({_off:true},15).wait(1));

	// レイヤー_9
	this.instance_2 = new lib.money("synched",0);
	this.instance_2._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_2).wait(39).to({_off:false},0).to({guide:{path:[0,0.1,-119.2,9.9,-157.9,150.7]}},30,cjs.Ease.quadOut).to({_off:true},20).wait(1));

	// レイヤー_8
	this.instance_3 = new lib.money("synched",0);
	this.instance_3._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_3).wait(34).to({_off:false},0).to({guide:{path:[0,0.1,-133.2,12,-154,161]}},30,cjs.Ease.quadOut).to({_off:true},25).wait(1));

	// レイヤー_7
	this.instance_4 = new lib.money("synched",0);
	this.instance_4._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_4).wait(29).to({_off:false},0).to({guide:{path:[0,0.1,-137.4,12.4,-155.2,170.4]}},30,cjs.Ease.quadOut).to({_off:true},30).wait(1));

	// レイヤー_6
	this.instance_5 = new lib.money("synched",0);
	this.instance_5._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_5).wait(24).to({_off:false},0).to({guide:{path:[0,0.1,-141.5,12.7,-156.2,179.9]}},30,cjs.Ease.quadOut).to({_off:true},35).wait(1));

	// レイヤー_5
	this.instance_6 = new lib.money("synched",0);
	this.instance_6._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_6).wait(19).to({_off:false},0).to({guide:{path:[0,0.1,-145.5,13,-156.9,189.5]}},30,cjs.Ease.quadOut).to({_off:true},40).wait(1));

	// レイヤー_4
	this.instance_7 = new lib.money("synched",0);
	this.instance_7._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_7).wait(14).to({_off:false},0).to({guide:{path:[0,0.1,-149.4,13.4,-157.4,199.2]}},30,cjs.Ease.quadOut).to({_off:true},45).wait(1));

	// レイヤー_3
	this.instance_8 = new lib.money("synched",0);
	this.instance_8._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_8).wait(9).to({_off:false},0).to({guide:{path:[0,0.1,-153.3,13.7,-157.8,208.9]}},30,cjs.Ease.quadOut).to({_off:true},50).wait(1));

	// レイヤー_1
	this.instance_9 = new lib.money("synched",0);
	this.instance_9._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_9).wait(4).to({_off:false},0).to({guide:{path:[0,0.1,-157,14.1,-157.9,218.6]}},29,cjs.Ease.quadOut).to({_off:true},56).wait(1));

	// レイヤー_1
	this.instance_10 = new lib.money("synched",0);

	this.timeline.addTween(cjs.Tween.get(this.instance_10).to({guide:{path:[0,0.1,-160.6,14.4,-157.8,228]}},29,cjs.Ease.quadOut).to({_off:true},60).wait(1));

	this._renderFirstFrame();

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-227,-29,295,286.3);


(lib.ATM_レール = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// timeline functions:
	this.frame_629 = function() {
		this.gotoAndPlay(540);
	}

	// actions tween:
	this.timeline.addTween(cjs.Tween.get(this).wait(629).call(this.frame_629).wait(1));

	// レイヤー_1
	this.instance = new lib.moneyanimation();

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(89).to({x:-70,y:34},10).wait(80).to({x:-140,y:68},10).wait(80).to({x:-210,y:102},10).wait(80).to({x:-280,y:136},10).wait(80).to({x:-350,y:170},10).wait(80).to({x:-420,y:204},10).wait(81));

	// レイヤー_2
	this.instance_1 = new lib.moneyanimation();
	this.instance_1._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_1).wait(89).to({_off:false},0).wait(90).to({x:-70,y:34},10).wait(80).to({x:-140,y:68},10).wait(80).to({x:-210,y:102},10).wait(80).to({x:-280,y:136},10).wait(80).to({x:-350,y:170},10).wait(81));

	// レイヤー_3
	this.instance_2 = new lib.moneyanimation();
	this.instance_2._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_2).wait(179).to({_off:false},0).wait(90).to({x:-70,y:34},10).wait(80).to({x:-140,y:68},10).wait(80).to({x:-210,y:102},10).wait(80).to({x:-280,y:136},10).wait(81));

	// レイヤー_4
	this.instance_3 = new lib.moneyanimation();
	this.instance_3._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_3).wait(269).to({_off:false},0).wait(90).to({x:-70,y:34},10).wait(80).to({x:-140,y:68},10).wait(80).to({x:-210,y:102},10).wait(81));

	// レイヤー_5
	this.instance_4 = new lib.moneyanimation();
	this.instance_4._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_4).wait(359).to({_off:false},0).wait(90).to({x:-70,y:34},10).wait(80).to({x:-140,y:68},10).wait(81));

	// レイヤー_6
	this.instance_5 = new lib.moneyanimation();
	this.instance_5._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_5).wait(449).to({_off:false},0).wait(90).to({x:-70,y:34},10).wait(81));

	// レイヤー_7
	this.instance_6 = new lib.moneyanimation("synched",0);
	this.instance_6._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_6).wait(539).to({_off:false},0).wait(90).to({startPosition:0},0).wait(1));

	this._renderFirstFrame();

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-489,-29,557,286.3);


(lib.atm_mask = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// レイヤー_3 (mask)
	var mask = new cjs.Shape();
	mask._off = true;
	mask.graphics.p("EhNhAvqMAAAhfTMB6ZAAAIRyddIO4HHQgQAAgBdXQAAOsACOsg");
	mask.setTransform(-472.7,109.025);

	// レイヤー_1
	this.instance = new lib.ATM_レール();
	this.instance.setTransform(7,8);

	var maskedShapeInstanceList = [this.instance];

	for(var shapedInstanceItr = 0; shapedInstanceItr < maskedShapeInstanceList.length; shapedInstanceItr++) {
		maskedShapeInstanceList[shapedInstanceItr].mask = mask;
	}

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

	this._renderFirstFrame();

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-62,-21,85.5,58);


// stage content:
(lib.atm2 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	this.actionFrames = [0];
	this.isSingleFrame = false;
	// timeline functions:
	this.frame_0 = function() {
		if(this.isSingleFrame) {
			return;
		}
		if(this.totalFrames == 1) {
			this.isSingleFrame = true;
		}
		this.clearAllSoundStreams();
		 
	}

	// actions tween:
	this.timeline.addTween(cjs.Tween.get(this).call(this.frame_0).wait(1));

	// レイヤー_1
	this.instance = new lib.シンボル45();
	this.instance.setTransform(601.65,388.6);

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

	// レイヤー_1
	this.instance_1 = new lib.シンボル48();
	this.instance_1.setTransform(1050.75,641.5);

	this.timeline.addTween(cjs.Tween.get(this.instance_1).wait(1));

	// レイヤー_1
	this.instance_2 = new lib.シンボル53();
	this.instance_2.setTransform(1047.7,31.05);

	this.timeline.addTween(cjs.Tween.get(this.instance_2).wait(1));

	// レイヤー_1
	this.instance_3 = new lib.シンボル42();
	this.instance_3.setTransform(407.15,258.25);

	this.timeline.addTween(cjs.Tween.get(this.instance_3).wait(1));

	// レイヤー_1
	this.instance_4 = new lib.シンボル43();
	this.instance_4.setTransform(330.55,529.7);

	this.timeline.addTween(cjs.Tween.get(this.instance_4).wait(1));

	// レイヤー_1
	this.instance_5 = new lib.atm_mask();
	this.instance_5.setTransform(917.45,438);

	this.timeline.addTween(cjs.Tween.get(this.instance_5).wait(1));

	// レイヤー_1
	this.instance_6 = new lib.シンボル41();
	this.instance_6.setTransform(954.9,377.5,1,1,0,0,0,2,0);

	this.timeline.addTween(cjs.Tween.get(this.instance_6).wait(1));

	this._renderFirstFrame();

}).prototype = p = new lib.AnMovieClip();
p.nominalBounds = new cjs.Rectangle(548.1,325,577.6,527.5);
// library properties:
lib.properties = {
	id: '0DBF3DF2BAFC5E4486BC5CCAD6BD3FDA',
	width: 1200,
	height: 776,
	fps: 60,
	color: "#1CAD3F",
	opacity: 1.00,
	manifest: [
		{src:"img/Image.png", id:"Image"},
		{src:"img/Image_0.png", id:"Image_0"},
		{src:"img/flash0aiアセット.png", id:"flash0aiアセット"},
		{src:"img/flash0aiアセット_1.png", id:"flash0aiアセット_1"},
		{src:"img/flash0aiアセット_2.png", id:"flash0aiアセット_2"},
		{src:"img/flash0aiアセット_3.png", id:"flash0aiアセット_3"},
		{src:"img/flash0aiアセット_4.png", id:"flash0aiアセット_4"},
		{src:"img/flash0aiアセット_5.png", id:"flash0aiアセット_5"},
		{src:"img/flash0aiアセット_6.png", id:"flash0aiアセット_6"},
		{src:"img/flash0aiアセット_7.png", id:"flash0aiアセット_7"},
		{src:"img/flash0aiアセット_8.png", id:"flash0aiアセット_8"}
	],
	preloads: []
};



// bootstrap callback support:

(lib.Stage = function(canvas) {
	createjs.Stage.call(this, canvas);
}).prototype = p = new createjs.Stage();

p.setAutoPlay = function(autoPlay) {
	this.tickEnabled = autoPlay;
}
p.play = function() { this.tickEnabled = true; this.getChildAt(0).gotoAndPlay(this.getTimelinePosition()) }
p.stop = function(ms) { if(ms) this.seek(ms); this.tickEnabled = false; }
p.seek = function(ms) { this.tickEnabled = true; this.getChildAt(0).gotoAndStop(lib.properties.fps * ms / 1000); }
p.getDuration = function() { return this.getChildAt(0).totalFrames / lib.properties.fps * 1000; }

p.getTimelinePosition = function() { return this.getChildAt(0).currentFrame / lib.properties.fps * 1000; }

an.bootcompsLoaded = an.bootcompsLoaded || [];
if(!an.bootstrapListeners) {
	an.bootstrapListeners=[];
}

an.bootstrapCallback=function(fnCallback) {
	an.bootstrapListeners.push(fnCallback);
	if(an.bootcompsLoaded.length > 0) {
		for(var i=0; i<an.bootcompsLoaded.length; ++i) {
			fnCallback(an.bootcompsLoaded[i]);
		}
	}
};

an.compositions = an.compositions || {};
an.compositions['0DBF3DF2BAFC5E4486BC5CCAD6BD3FDA'] = {
	getStage: function() { return exportRoot.stage; },
	getLibrary: function() { return lib; },
	getSpriteSheet: function() { return ss; },
	getImages: function() { return img; }
};

an.compositionLoaded = function(id) {
	an.bootcompsLoaded.push(id);
	for(var j=0; j<an.bootstrapListeners.length; j++) {
		an.bootstrapListeners[j](id);
	}
}

an.getComposition = function(id) {
	return an.compositions[id];
}


an.makeResponsive = function(isResp, respDim, isScale, scaleType, domContainers) {		
	var lastW, lastH, lastS=1;		
	window.addEventListener('resize', resizeCanvas);		
	resizeCanvas();		
	function resizeCanvas() {			
		var w = lib.properties.width, h = lib.properties.height;			
		var iw = window.innerWidth, ih=window.innerHeight;			
		var pRatio = window.devicePixelRatio || 1, xRatio=iw/w, yRatio=ih/h, sRatio=1;			
		if(isResp) {                
			if((respDim=='width'&&lastW==iw) || (respDim=='height'&&lastH==ih)) {                    
				sRatio = lastS;                
			}				
			else if(!isScale) {					
				if(iw<w || ih<h)						
					sRatio = Math.min(xRatio, yRatio);				
			}				
			else if(scaleType==1) {					
				sRatio = Math.min(xRatio, yRatio);				
			}				
			else if(scaleType==2) {					
				sRatio = Math.max(xRatio, yRatio);				
			}			
		}			
		domContainers[0].width = w * pRatio * sRatio;			
		domContainers[0].height = h * pRatio * sRatio;			
		domContainers.forEach(function(container) {				
			container.style.width = w * sRatio + 'px';				
			container.style.height = h * sRatio + 'px';			
		});			
		stage.scaleX = pRatio*sRatio;			
		stage.scaleY = pRatio*sRatio;			
		lastW = iw; lastH = ih; lastS = sRatio;            
		stage.tickOnUpdate = false;            
		stage.update();            
		stage.tickOnUpdate = true;		
	}
}
an.handleSoundStreamOnTick = function(event) {
	if(!event.paused){
		var stageChild = stage.getChildAt(0);
		if(!stageChild.paused){
			stageChild.syncStreamSounds();
		}
	}
}


})(createjs = createjs||{}, AdobeAn = AdobeAn||{});
var createjs, AdobeAn;