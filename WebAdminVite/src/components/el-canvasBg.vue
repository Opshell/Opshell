<template>
    <canvas id="canvas" ref="canvasBg"></canvas>
</template>

<script setup lang="ts">
    const oninitCanvas = () => {
        nextTick(() => {
            const canvas = <HTMLCanvasElement | null>document.getElementById('canvas');

            if (canvas != null) {
                let w = (canvas.width = window.innerWidth),
                    h = (canvas.height = window.innerHeight);

                const ctx = canvas.getContext('2d'),
                    opts = {
                        len: 30, // 前進格數&六角路徑大小 (基礎為20)
                        count: 40, // 線條數量，數字越小移動越快(可能和運算數度有關)(基礎50)
                        baseTime: 8, // 刷新時間? (數字越小 跑越快)
                        addedTime: 8,
                        dieChance: 0.01, // 消失機率(基礎 0.05)
                        spawnChance: 1, // 生成機率
                        sparkChance: 0.1, // 閃爍機率
                        sparkDist: 9, // 火花距離 (基礎10)
                        sparkSize: 3, // 火花大小 (基礎2)
                        color: 'hsl(214,100%,light%)', // 基底色  'hsl(hue,100%,light%)' 卡死就不會變色
                        baseLight: 50, // 線的基礎明度
                        addedLight: 10, // 移動時的明度變化
                        shadowToTimePropMult: 5, // 燒焦痕跡的寬度
                        baseLightInputMultiplier: 0.01,
                        addedLightInputMultiplier: 0.02,
                        cx: w / 2, // 中心點X
                        cy: h / 2, // 中心點Y
                        repaintAlpha: 0.025, // 遞減透明參數(0~1) 越小遞減越慢
                        hueChange: 0.4, // 變色幅度 (0~1) 越大跨越多
                    };

                let tick = 0,
                    lines = [],
                    dieX = w / 2 / opts.len, // 邊界設定
                    dieY = h / 2 / opts.len,
                    baseRad = (Math.PI * 2) / 6; // 生成幾角型 的參數 最後數字代表幾角

                if (ctx != null) {
                    ctx.fillStyle = 'black';
                    ctx.fillRect(0, 0, w, h);

                    const loop = function () {
                        window.requestAnimationFrame(loop);
                        ++tick;

                        ctx.globalCompositeOperation = 'source-over';
                        ctx.shadowBlur = 0;
                        ctx.fillStyle = 'rgba(0,0,0,alp)'.replace('alp', opts.repaintAlpha);
                        ctx.fillRect(0, 0, w, h);

                        ctx.globalCompositeOperation = 'lighter';
                        // 生成
                        if (lines.length < opts.count && Math.random() < opts.spawnChance) {
                            lines.push(new Line());
                        }
                        lines.map(function (line) {
                            line.step();
                        });
                    };

                    const Line = function () {
                        this.reset();
                    };
                    // [-] 開場或死亡時進行的處理(回復原廠設定)
                    Line.prototype.reset = function () {
                        this.x = 0;
                        this.y = 0;
                        this.addedX = 0;
                        this.addedY = 0;
                        this.rad = 0;
                        this.lightInputMultiplier = opts.baseLightInputMultiplier + opts.addedLightInputMultiplier * Math.random();

                        this.color = opts.color.replace('hue', tick * opts.hueChange);
                        this.cumulativeTime = 0;
                        this.beginPhase();
                    };
                    // [-] 依目前參數生成LINE
                    Line.prototype.beginPhase = function () {
                        this.x += this.addedX;
                        this.y += this.addedY;
                        this.time = 0;
                        this.targetTime = (opts.baseTime + opts.addedTime * Math.random()) | 0;
                        this.rad += baseRad * (Math.random() < 0.5 ? 1 : -1);
                        this.addedX = Math.cos(this.rad);
                        this.addedY = Math.sin(this.rad);
                        // 是否死亡 隨機到死亡或者 超出邊界?
                        if (Math.random() < opts.dieChance || this.x > dieX || this.x < -dieX || this.y > dieY || this.y < -dieY) {
                            this.reset();
                        }
                    };
                    // [-] 移動
                    Line.prototype.step = function () {
                        ++this.time;
                        ++this.cumulativeTime;
                        if (this.time >= this.targetTime) {
                            // 用來判斷要不要移動?
                            this.beginPhase();
                        }

                        let prop = this.time / this.targetTime,
                            wave = Math.sin((prop * Math.PI) / 2), // 波動? 角度?
                            x = this.addedX * wave,
                            y = this.addedY * wave;

                        ctx.shadowBlur = prop * opts.shadowToTimePropMult; // 生成燒焦路徑
                        ctx.fillStyle = ctx.shadowColor = this.color.replace('light', opts.baseLight + opts.addedLight * Math.sin(this.cumulativeTime * this.lightInputMultiplier));
                        ctx.fillRect(opts.cx + (this.x + x) * opts.len, opts.cy + (this.y + y) * opts.len, 2, 2);
                        // 是否生成火花
                        if (Math.random() < opts.sparkChance) {
                            ctx.fillRect(opts.cx + (this.x + x) * opts.len + Math.random() * opts.sparkDist * (Math.random() < 0.5 ? 1 : -1) - opts.sparkSize / 2, opts.cy + (this.y + y) * opts.len + Math.random() * opts.sparkDist * (Math.random() < 0.5 ? 1 : -1) - opts.sparkSize / 2, opts.sparkSize, opts.sparkSize);
                        }
                    };

                    loop();

                    // 改變尺寸時  重製 畫布規格
                    window.addEventListener('resize', function () {
                        w = canvas.width = window.innerWidth;
                        h = canvas.height = window.innerHeight;
                        ctx.fillStyle = 'black';
                        ctx.fillRect(0, 0, w, h);
                        opts.cx = w / 2;
                        opts.cy = h / 2;
                        dieX = w / 2 / opts.len;
                        dieY = h / 2 / opts.len;
                    });
                }
            }
        });
    };

    onMounted(() => {
        oninitCanvas();
    });
</script>

<style lang="scss">
    #canvas {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        background-color: rgb(73, 73, 73);
        @include setSize(100%, 100%);
    }
</style>
