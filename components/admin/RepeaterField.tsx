"use client";

import { useState } from "react";
import type { SubField } from "./contentSchema";

type Props = {
  name: string;
  label: string;
  itemLabel: string;
  /** Si hay subfields => lista de objetos; si no => lista de textos. */
  subfields?: SubField[];
  initial: unknown;
};

type Item = string | Record<string, unknown>;

export default function RepeaterField({
  name,
  label,
  itemLabel,
  subfields,
  initial,
}: Props) {
  const isObject = Boolean(subfields);
  const [items, setItems] = useState<Item[]>(() =>
    Array.isArray(initial) ? (initial as Item[]) : []
  );

  function emptyItem(): Item {
    if (!isObject) return "";
    const obj: Record<string, unknown> = {};
    subfields!.forEach((sf) => (obj[sf.name] = sf.kind === "number" ? 0 : ""));
    return obj;
  }

  function update(next: Item[]) {
    setItems(next);
  }

  function setText(i: number, v: string) {
    const next = [...items];
    next[i] = v;
    update(next);
  }

  function setField(i: number, key: string, v: string, kind?: string) {
    const next = [...items];
    next[i] = { ...(next[i] as object), [key]: kind === "number" ? Number(v) : v };
    update(next);
  }

  function addItem() {
    update([...items, emptyItem()]);
  }

  function removeItem(i: number) {
    update(items.filter((_, idx) => idx !== i));
  }

  function move(i: number, dir: -1 | 1) {
    const j = i + dir;
    if (j < 0 || j >= items.length) return;
    const next = [...items];
    [next[i], next[j]] = [next[j], next[i]];
    update(next);
  }

  return (
    <div className="field">
      <label>{label}</label>
      {/* El valor real que se envía al servidor (oculto). */}
      <input type="hidden" name={`json__${name}`} value={JSON.stringify(items)} readOnly />

      <div className="repeater">
        {items.map((item, i) => (
          <div className="repeater-item" key={i}>
            <div className="repeater-item-head">
              <span className="muted">{itemLabel} {i + 1}</span>
              <div className="row-actions">
                <button type="button" className="abtn secondary small" onClick={() => move(i, -1)} disabled={i === 0} aria-label="Subir">↑</button>
                <button type="button" className="abtn secondary small" onClick={() => move(i, 1)} disabled={i === items.length - 1} aria-label="Bajar">↓</button>
                <button type="button" className="abtn danger small" onClick={() => removeItem(i)}>Quitar</button>
              </div>
            </div>

            {isObject ? (
              <div className={subfields!.length > 2 ? "field-row-3" : "field-row"}>
                {subfields!.map((sf) => (
                  <div className="field" key={sf.name} style={{ marginBottom: 0 }}>
                    <label style={{ fontSize: ".72rem" }}>{sf.label}</label>
                    <input
                      type={sf.kind === "number" ? "number" : "text"}
                      value={String((item as Record<string, unknown>)[sf.name] ?? "")}
                      onChange={(e) => setField(i, sf.name, e.target.value, sf.kind)}
                    />
                  </div>
                ))}
              </div>
            ) : (
              <textarea
                value={String(item)}
                onChange={(e) => setText(i, e.target.value)}
                style={{ minHeight: 60 }}
              />
            )}
          </div>
        ))}
      </div>

      <button type="button" className="abtn secondary small" onClick={addItem} style={{ marginTop: ".5rem" }}>
        + Agregar {itemLabel.toLowerCase()}
      </button>
    </div>
  );
}
