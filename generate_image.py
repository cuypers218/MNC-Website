import requests
import os
import time

HF_TOKEN = "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"
MODEL_ID = "black-forest-labs/FLUX.1-schnell"
API_URL = f"https://router.huggingface.co/hf-inference/models/{MODEL_ID}"
OUT_DIR = os.path.dirname(__file__)

IMAGES = [
    {
        "filename": "bg-kitchen.jpg",
        "prompt": "empty kitchen at dusk, warm fading light through window, no people, dark moody interior, slightly underexposed, residential home, real photography style, no bright sunshine"
    },
    {
        "filename": "bg-hallway.jpg",
        "prompt": "long empty residential hallway, closed door at the end, dim light, dark moody interior, no people, slightly underexposed, real photography style"
    },
    {
        "filename": "bg-phone.jpg",
        "prompt": "smartphone face-up on a kitchen counter, dark room, dim light, no hands, no people, moody interior, slightly underexposed, real photography style"
    },
    {
        "filename": "bg-tv.jpg",
        "prompt": "dark living room with blue grey television glow on the walls, no one watching, empty couch, moody dark interior, real photography style, slightly underexposed"
    },
    {
        "filename": "bg-phone-lit.jpg",
        "prompt": "smartphone screen glowing in a very dark room, phone lying on a surface untouched, no hands, no people, dark moody atmosphere, real photography style"
    },
    {
        "filename": "bg-window.jpg",
        "prompt": "interior view of a window at night, dark outside, distant streetlight, dark quiet room, no people, moody slightly underexposed, real photography style"
    },
    {
        "filename": "bg-cozy.jpg",
        "prompt": "cozy quiet living room, warm lamp on, soft blanket on couch, cup of tea on table, no people, dim warm light, slightly underexposed, real photography style, intimate residential interior"
    },
]


def generate(filename, prompt):
    headers = {"Authorization": f"Bearer {HF_TOKEN}"}
    payload = {"inputs": prompt}
    print(f"Generating {filename} ...")
    for attempt in range(3):
        response = requests.post(API_URL, headers=headers, json=payload, timeout=120)
        if response.status_code == 200:
            path = os.path.join(OUT_DIR, filename)
            with open(path, "wb") as f:
                f.write(response.content)
            print(f"  Saved: {path}")
            return True
        elif response.status_code == 503:
            print(f"  Model loading, waiting 20s... (attempt {attempt + 1}/3)")
            time.sleep(20)
        else:
            print(f"  Error {response.status_code}: {response.text}")
            return False
    print(f"  Failed after 3 attempts.")
    return False


FRIDGE_IMAGE = {
    "filename": "bg-fridge.jpg",
    "prompt": (
        "view from a doorway looking into a dim kitchen, closed refrigerator in focus, "
        "dark quiet residential kitchen, no people, moody slightly underexposed interior, "
        "warm available light, real photography style, shallow depth of field"
    )
}

if __name__ == "__main__":
    generate(FRIDGE_IMAGE["filename"], FRIDGE_IMAGE["prompt"])
    print("\nDone.")
